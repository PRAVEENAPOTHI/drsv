<?php
require 'vendor/autoload.php'; // Ensure PHPMailer is installed via Composer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $service = htmlspecialchars($_POST['service']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server (e.g., smtp.gmail.com)
        $mail->SMTPAuth = true;
        $mail->Username = 'praveenapothirk28@gmail.com'; // Your SMTP username (email)
        $mail->Password = 'invm ioto xqow pudl'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use TLS encryption
        $mail->Port = 587; // Port for TLS (Use 465 for SSL)


        // Email Headers
        $mail->setFrom($email, $name);
        $mail->addAddress('praveenapothirk28@gmail.com'); // Change to recipient email
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Quote Request';
        $mail->Body = "
            <h3>New Quote Request</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Mobile:</strong> $mobile</p>
            <p><strong>Service:</strong> $service</p>
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
