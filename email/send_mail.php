<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if (isset($_GET['action']) && $_GET['action'] == 'mail') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $subject = $_POST['subject'];
        $content = $_POST['content'];
    }


    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'cactus030702@gmail.com';                     //SMTP username
        $mail->Password   = 'ybxp clkr afzb lfxs';                            //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('cactus030702@gmail.com', 'Trung Nghĩa');

        $mail->addAddress('qtnghia2002@gmail.com', 'Trung Nghĩa');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cactus030702@gmail.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo '<p class="text-center mt-3">Nội dung góp ý đã được gửi thành công</p>';
    } catch (Exception $e) {
        echo '<p class="text-center mt-3">Nội dung góp ý gửi thất bại.</p>';
    }
}
?>