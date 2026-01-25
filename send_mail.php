<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

function sendMail($to, $subject, $message) {

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // 🔴 CHANGE THESE TWO LINES LATER
        $mail->Username = 'douzagenelia@gmail.com';
        $mail->Password = 'mprn zmov jgjb mphm';

        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('YOUR_GMAIL@gmail.com', 'Pension System');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

    } catch (Exception $e) {
        // ignore errors for project
    }
}
?>
