<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="scripts/form-validation.js" defer></script>
</head>
<body>
    <?php include 'components/header.php'; ?>
    <div class="login-form">
        <h2>Login</h2>
        <form action="scripts/auth.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Login</button>
        </form>
        <a href="#">Forgot Password?</a>
    </div>
    <?php include 'components/footer.php'; ?>
</body>
</html>