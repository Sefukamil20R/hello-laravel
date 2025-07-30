<!DOCTYPE html>
<html>
<head>
    <title>Auth</title>
</head>
<body>
    <h2>Register</h2>
    <form method="POST" action="/api/register">
        <!-- @csrf -->
        <input name="name" placeholder="Name" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <input name="password_confirmation" type="password" placeholder="Confirm Password" required>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Register</button>
    </form>

    <h2>Login</h2>
    <form method="POST" action="/api/login">
        <!-- @csrf -->
        <input name="email" type="email" placeholder="Email" required>
        <input name="password" type="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
<script>
document.querySelector('form[action="/api/register"]').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('Register clicked');
    const form = e.target;
    const data = new FormData(form);
    const res = await fetch('/api/register', {
        method: 'POST',
        body: data
    });
    console.log(res);
    try {
        const json = await res.json();
        alert('Register: ' + JSON.stringify(json));
    } catch (err) {
        alert('Register error: ' + err);
    }
});

document.querySelector('form[action="/api/login"]').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('Login clicked');
    const form = e.target;
    const data = new FormData(form);
    const res = await fetch('/api/login', {
        method: 'POST',
        body: data
    });
    console.log(res);
    try {
        const json = await res.json();
        alert('Login: ' + JSON.stringify(json));
    } catch (err) {
        alert('Login error: ' + err);
    }
});
</script>
</body>
</html>