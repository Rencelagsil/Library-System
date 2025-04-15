<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Registration - Lathoug's Library</title>
  <link rel="stylesheet" href="registration.css" />
</head>
<body>
  <main class="login-container">
    <img src="logo.png" alt="Library Logo" class="logo" />
    <h1>Student Registration</h1>
    <form action="student_registration.php" method="POST">
      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="studentId">Student ID</label>
        <input type="text" id="studentId" name="studentId" required />
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="password">Create Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required />
      </div>
      <div class="form-options">
        <a href="login.html" class="forgot-password">Already have an account?</a>
      </div>
      <button type="submit" class="login-btn">Register</button>
    </form>
    <footer class="footer">
      <p>&copy; 2025 Lathoug's Library. All rights reserved.</p>
    </footer>
  </main>
</body>
</html>
