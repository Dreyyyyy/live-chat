<head>
    <link rel="stylesheet" href="/live-chat/public/css/styles.css">
</head>

<?php if (!empty($errorMessage)): ?>
    <div class="error-message"><?php echo htmlspecialchars($errorMessage); ?></div>
<?php endif; ?>

<form action="/live-chat/public/index.php/login" method="POST">
    <input type="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<a href="/live-chat/public/index.php/register">Register</a>
