<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;

Route::resource('posts', PostController::class);

Route::middleware(['auth:sanctum'])->get('/me', function (Request $request) {
    return response()->json($request->user());
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// // Login POST route
// Route::post('/login', function (Request $request) {
//     $credentials = $request->validate([
//         'email' => 'required|email',
//         'password' => 'required',
//     ]);

//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate();
//         return redirect('/dashboard'); // or response()->json(Auth::user());
//     }

//     return back()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ]);
// });


Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return response()->json(['message' => 'Login successful']);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
});
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return response()->json(['message' => 'Logged out']);
});
