<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'in:pending,completed,in_progress',
            'priority' => 'in:low,medium,high',
            'deadline' => 'required|date',
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $fields['title'],
            'description' => $fields['description'] ?? null,
            'status' => $fields['status'] ?? 'pending',
            'priority' => $fields['priority'] ?? 'medium',
            'deadline' => $fields['deadline'],
        ]);

        return response()->json($task, 201);
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return response()->json(Task::all());
        }
        return response()->json($user->tasks);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'admin' && $task->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->update($request->only(['title', 'description', 'status', 'priority', 'deadline']));
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $user = Auth::user();

        if ($user->role !== 'admin' && $task->user_id !== $user->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $task->delete();
        return response()->json(['message' => 'Task deleted']);
    }
}