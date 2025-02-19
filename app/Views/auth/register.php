<head>
    <link rel="stylesheet" href="/live-chat/public/css/styles.css">
</head>

<form action="/live-chat/public/index.php/register" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="file" name="profile_picture">
    <button type="submit">Register</button>
</form>

<a href="/live-chat/public/index.php/login">Login</a>
