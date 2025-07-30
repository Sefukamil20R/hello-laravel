<!DOCTYPE html>
<html>
<head>
    <title>Tasks</title>
</head>
<body>
    <h2>Task List</h2>
    <!-- You can use AJAX or Blade to fetch and display tasks -->
    <!-- Add forms for create, update, delete, and logout as needed -->
    <form method="POST" action="/api/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>