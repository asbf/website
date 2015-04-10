<?php
date_default_timezone_set('UTC');
require '../includes/PHPMailer/PHPMailerAutoload.php';
require '../includes/mail.php';

$Name = Trim(stripslashes($_POST['nom']));
$Email = Trim(stripslashes($_POST['email']));
$Date = Trim(stripslashes($_POST['date']));
$Lieu = Trim(stripslashes($_POST['lieu']));
$Asso = Trim(stripslashes($_POST['asso']));
$Website = Trim(stripslashes($_POST['website']));
$Message = '<img src="http://asbf.fr/img/header.png" style="max-width: 100%;"><h1>Contact depuis le site ASBF.fr</h1><hr>';
$Message = $Message ."<b>De :</b> ". $Name ." - ". $Email ."<br><b>Date :</b> ". $Date ."<br><b>Lieu :</b> ". $Lieu ."<br>";
$Message = $Message ."<b>Association :</b> ". $Asso ." - <a href='". $Website ."'>". $Website ."</a><br><br><b>Descriptif :</b><br>";
$Message = $Message . Trim(stripslashes($_POST['descriptif']));
$Bot = Trim(stripslashes($_POST['captcha']));
$SendSelf = Trim(stripslashes($_POST['self']));

if(!empty($Bot)) {
    print "<meta http-equiv=\"refresh\" content=\"0;URL=./?bot\">";
} else {
    $mail = new PHPMailer();
    $mail->isSMTP();

    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';

    $mail->Host = $mailHost;
    $mail->Port = $mailPort;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $mailUser;
    $mail->Password = $mailPass;

    $mail->setFrom($Email, $Name);
    $mail->addReplyTo($Email, $Name);
    $mail->addAddress('contact@asbf.fr', 'Contact ASBF');
    if($SendSelf) $mail->addCC($Email);

    $mail->Subject = "[Proposition Meet-up] '". $Asso ."' le ". $Date;
    $mail->Body = nl2br($Message);
    $mail->AltBody = $Message;

    //send the message, check for errors
    if (!$mail->send()) {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=./?error\">";
    } else {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=./?success\">";
    }
}
