<?php
$servername = "localhost";
$username = "root";   
$password = "";       
$database = "registration_system";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$token = $_GET['token'] ?? $_POST['token'] ?? '';
if (!$token) {
    die("<h2 style='color:red;'>Invalid access. No token provided.</h2>");
}

$stmt = $conn->prepare("SELECT id FROM registered_userdetails WHERE token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("<h2 style='color:red;'>Invalid or expired token.</h2>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validation
    if (strlen($password) < 6 ) {
        echo "<h3 style='color:red;'>Password must be at least 6 characters long.</h3>";
    } elseif ($password !== $confirmPassword) {
        echo "<h3 style='color:red;'> Passwords do not match!</h3>";
    } else {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Update password and clear token
        $update = $conn->prepare("UPDATE registered_userdetails SET password = ?, token = NULL WHERE token = ?");
        $update->bind_param("ss", $hashedPassword, $token);

        if ($update->execute()) {
            echo "<h2 style='color:green;'> Password has been set successfully!</h2>";
            echo "<p>You can now <a href='login.html'>Login</a> with your new password.</p>";
            exit;
        } else {
            echo "<h3 style='color:red;'>Failed to update password. Please try again.</h3>";
        }
    }
} else {
    // Redirect to password form if accessed via link
    header("Location: set_password_form.php?token=" . urlencode($token));
    exit;
}

$conn->close();
?>
