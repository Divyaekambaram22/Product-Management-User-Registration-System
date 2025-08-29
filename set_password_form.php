<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Set Your Password</title>
  <link rel="stylesheet" href="Mainpage.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .page-content {
      display: flex;
      justify-content: center;
      align-items: center;
      height: calc(100vh - 80px); 
    }

    .container {
      background: white;
      padding: 20px 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
      width: 350px;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    label {
      font-weight: bold;
    }

    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      width: 100%;
      padding: 10px;
      background: #28a745;
      border: none;
      color: white;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background: #218838;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="logo">Product Management & User Registration System</div>
    <div class="nav-links">
      <a href="MainPage.html">Home</a>
      <a href="login.html">Login</a>
      <a href="Register.html">Register</a>
      <a href="Admin.php">Admin</a>
    </div>
  </div>


  <div class="page-content">
    <div class="container">
      <h2>Set Your Password</h2>
      <form method="post" action="set_password.php">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">

        <label>New Password:</label>
        <input type="password" name="password" required>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" required>

        <button type="submit">Save Password</button>
      </form>
    </div>
  </div>

</body>
</html>
