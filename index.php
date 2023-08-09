<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="secondary">
            <h1>Student Login System</h1>
            <form action="login_process.php" method="post">
                <label for="username">Username:</label>
                <input type="text" name="username" required><br>
                <label for="password">Password:</label>
                <input type="password" name="password" required><br>
                <button type="submit">Login</button>
                <button><a type="button" href="register.php">Register</a></button>
            </form>
        </div>
    </div>
</body>
</html>
