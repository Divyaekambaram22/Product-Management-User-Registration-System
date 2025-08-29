<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$database = "registration_system";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $database");

$conn->select_db($database);

$conn->query("
    CREATE TABLE IF NOT EXISTS registered_userdetails (
        id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        dob DATE NOT NULL,
        languages VARCHAR(255),
        country VARCHAR(50) NOT NULL,
        state VARCHAR(50) NOT NULL,
        city VARCHAR(50) NOT NULL,
        password VARCHAR(255) NULL,
        token VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $languages = isset($_POST['languages']) ? implode(", ", $_POST['languages']) : '';

    $token = bin2hex(random_bytes(16));

    $stmt = $conn->prepare("
        INSERT INTO registered_userdetails
        (first_name, last_name, username, email, dob, languages, country, state, city, token) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("ssssssssss", $firstName, $lastName, $username, $email, $dob, $languages, $country, $state, $city, $token);

    if ($stmt->execute()) {
        $base = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') 
                . '://' . $_SERVER['HTTP_HOST'] 
                . dirname($_SERVER['PHP_SELF']);

        $resetLink = $base . '/set_password_form.php?token=' . urlencode($token);

        $subject = "Registration Successful - Set Your Password";
        $message = "
            Hi $firstName $lastName,<br><br>
            Thank you for registering.<br>
            Please click the link below to set your password:<br>
            <a href='$resetLink'>$resetLink</a><br><br>
            Regards,<br>Divya Innovations Ltd
        ";
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'divyaasm21@gmail.com';
            $mail->Password   = ' Removed Password';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('divyaasm21@gmail.com', 'Divya Innovations Ltd');
            $mail->addAddress($email, "$firstName $lastName");

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo "<h2 style='color:green;'> Successfully Registered!</h2>";
            echo "<p>Please check your Gmail (<b>$email</b>) and click the link to set your password.</p>";
        } catch (Exception $e) {
            echo "<h2> Registered, but email sending failed!</h2>";
            echo "<p><b>Mailer Error:</b> " . $mail->ErrorInfo . "</p>";
        }

    } else {
        echo "<h2> Registration Failed!</h2>";
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
