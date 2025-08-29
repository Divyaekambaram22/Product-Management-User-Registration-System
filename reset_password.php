<?php
session_start();
$conn = new mysqli("localhost", "root", "", "registration_system");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; 

if (isset($_POST['reset_password'])) {
    $entered_otp = $_POST['otp'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'] ?? '';

    if (!$email) {
        $message = "<p class='error'> Session expired. Please try again.</p>";
    } elseif ($entered_otp != ($_SESSION['otp'] ?? '')) {
        $message = "<p class='error'>Invalid OTP!</p>";
    } elseif ($new_password !== $confirm_password) {
        $message = "<p class='error'> Passwords do not match!</p>";
    } else {
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE registered_userdetails SET password=? WHERE email=?");
        $stmt->bind_param("ss", $hashed, $email);

        if ($stmt->execute()) {
            $message = "<p class='success'> Password reset successful! ";
            session_destroy();
        } else {
            $message = "<p class='error'> Error resetting password!</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link rel="stylesheet" href="reset_password.css">
</head>
<body>
  <div class="login-container">
    <h2>Reset Password</h2>
    <form action="reset_password.php" method="POST">
      <label for="otp">Enter OTP</label>
      <input type="text" name="otp" required placeholder="Enter OTP">

      <label for="new_password">New Password</label>
      <input type="password" name="new_password" required placeholder="Enter New Password">

      <label for="confirm_password">Confirm Password</label>
      <input type="password" name="confirm_password" required placeholder="Confirm Password">

      <div class="button-container">
        <button type="submit" name="reset_password" class="login-btn">Submit</button>
      </div>
      <div class="bottom-buttons">
        <a href="forgot_password.html" class="link-btn">Resend OTP</a>
        <a href="login.html" class="link-btn">Go to Login</a>
      </div>
    </form>
    
    <div class="message-box">
      <?php echo $message; ?>
    </div>
  </div>
</body>
</html>
