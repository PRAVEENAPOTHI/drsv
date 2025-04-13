<?php
require 'vendor/autoload.php'; // Load all dependencies

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $message = htmlspecialchars($_POST['message']);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'drsvtechnosolution@gmail.com'; 
        $mail->Password = 'drkd tocr zplh shzj';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
        $mail->Port = 587; 

        // Email Headers
        $mail->setFrom('drsvtechnosolution@gmail.com', 'DRSV');
        $mail->addAddress('drsvtechnosolution@gmail.com'); 
        $mail->addReplyTo($email, $name); 

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h3>New Message from Contact Form</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Mobile:</strong> $mobile</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // Send Email
        if ($mail->send()) {
            echo "<script>
            alert('Mail sent successfully!');
            window.location.href='index.html';
          </script>";
    exit();
        } else {
            echo "Mail sending failed!";
        }
    } catch (Exception $e) {
        echo "Mail sending failed! Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request!";
}
?>
