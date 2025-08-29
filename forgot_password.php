
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

$conn = new mysqli("localhost", "root", "", "registration_system");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

if (isset($_POST['send_otp'])) {
    $email = trim($_POST['email']);

    $stmt = $conn->prepare("SELECT * FROM registered_userdetails WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "divyaasm21@gmail.com";
            $mail->Password = " Removed Password";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            $mail->setFrom("divyaasm21@gmail.com", "Divya Innovations Ltd");
            $mail->addAddress($email);
            $mail->Subject = "Your OTP Code";
            $mail->Body = "Your OTP is: $otp";

            $mail->send();
            header("Location: reset_password.php");
            exit;
        } catch (Exception $e) {
            echo "Error: Could not send OTP.";
        }
    } else {
        echo "Email not registered!";
    }
}
