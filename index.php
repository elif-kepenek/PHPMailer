<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/vendor/autoload.php';

$faker = \Faker\Factory::create('tr_TR');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if(isset($_POST['submit'])){
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = '***@gmail.com';                     //SMTP username
        $mail->Password   = '******';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet    = PHPMailer::CHARSET_UTF8;

        //Recipients
        $mail->setFrom('***@gmail.com', 'PHPMail');
        $mail->addAddress($_POST['email'], $_POST['isim']);     //Add a recipient

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        $mail->addAttachment('./euler.jpg', 'euler.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $_POST['isim'];
        $mail->Body    = 'Sayın '.$_POST['isim'].' mailiniz bize ulaştı. En kısa sürede dönüş yapacağız.';
        $mail->AltBody = 'Sayın '.$_POST['isim'].' mailiniz bize ulaştı. En kısa sürede dönüş yapacağız.';

        $mail->send();
        echo 'Form gönderildi.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<form action="" method="post">
    <span>Ad-Soyad</span><input type="text" name="isim" value="<?= $faker->firstName().' '.$faker->lastName(); ?>"><br>
    <span>E-mail</span><input type="email" name="email" value="elif.kepenek.98@gmail.com">
    <button type="submit" name="submit" value="1">Gönder</button>
</form>
