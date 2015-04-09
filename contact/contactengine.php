<?php
date_default_timezone_set('CEST');
require '../includes/PHPMailer/PHPMailerAutoload.php';
require '../includes/mail.php';

$Subject = [['contact@asbf.fr', 'Bureau ASBF'], ['secretaire@asbf.fr', 'Secrétaire ASBF'], ['tresorier@asbf.fr', 'Trésorier ASBF'], ['tech@asbf.fr', 'Technique ASBF'], ['contact@asbf.fr', 'Général ASBF']];

$i = Trim(stripslashes($_POST['select']));
$Name = Trim(stripslashes($_POST['nom']));
$Email = Trim(stripslashes($_POST['email']));
$Message = '<img src="http://asbf.fr/img/header.png" style="max-width: 100%;"><h1>Contact depuis le site ASBF.fr</h1><hr>';
$Message = $Message ."<b>De :</b> ". $Name ." - ". $Email ."<br><br><b>Message :</b> <br>";
$Message = $Message . Trim(stripslashes($_POST['message']));
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
    $mail->addAddress($Subject[$i][0], $Subject[$i][1]);
    if($SendSelf) $mail->addCC($Email);

    $mail->Subject = "[". $Subject[$i][1] ."] Message de ". $Name ." <". $Email .">";
    $mail->Body = nl2br($Message);
    $mail->AltBody = $Message;

    echo $Message ."<br>";

    var_dump($mail);
    die();

    //send the message, check for errors
    if (!$mail->send()) {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=./?error\">";
    } else {
        print "<meta http-equiv=\"refresh\" content=\"0;URL=./?success\">";
    }
}
