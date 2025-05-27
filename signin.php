
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lathoug's Library - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <main class="login-container">
        <img src="logo.png" alt="Lathoug's Library Logo" class="logo">
        <h1>Lathoug's Library</h1>
       <form action="login.php" method="post" aria-labelledby="login-form">

    <div class="form-group">
        <label for="student_id" id="student_id-label">Student ID</label>
        <input type="text" id="student_id" name="student_id" required aria-labelledby="student_id-label">
    </div>
    <div class="form-group">
        <label for="password" id="password-label">Password</label>
        <input type="password" id="password" name="password" required aria-labelledby="password-label">
    </div>
    <div class="form-options">
        <a href="student_registration.php" class="forgot-password">Register</a>
        <a href="#" class="forgot-password">Forgot Password?</a>
    </div>
    <button type="submit" class="login-btn">Log In</button>
</form>

        <footer class="footer">
            <p>&copy; 2025 Lathoug's Library. All rights reserved.</p>
        </footer>
    </main>
</body>
</html>
