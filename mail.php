<?php

require 'vendor/autoload.php';
include_once("database/mock.php");
session_start();
$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'itgoodiesmailer@gmail.com';                 // SMTP username
$mail->Password = 'azerty0000';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$mail->CharSet = 'UTF-8';

$mail->setFrom('itgoodiesmailer@gmail.com', 'Goodies : Validation');
$mail->addAddress($_REQUEST['mail'], 'Joe User');     // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');

$mail->isHTML(true);                                  // Set email format to HTML
$total=0;
$mail->Body = 'Bonjour '.$_REQUEST['name'].',<br><br>Nous sommes heureux de vous annoncer que votre commande a bien été prise en compte.<br>Nous vous livrerons dans les plus brefs délais.';
$mail->Body .= '<br>Voici un récapitulatif de votre commande :<br>';

foreach ($articles["title"] as $key => $value) {
  $id = $key-1;
  if (isset($_SESSION[$value])) {
    $total+=$articles["prix"][$key];
    $mail->Body .= $value." : ".$articles["prix"][$key].' €<br>';
  }
}
$mail->Body .= '<br>Pour un total de : '.$total.' €<br><br>Nous esperons vous revoir très bientôt !';
$mail->Subject = 'Votre Commande a été validé !';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  foreach ($articles["title"] as $key => $value) {
    if (isset($_SESSION[$value])) {
      unset($_SESSION[$value]);
    }
  }
  header('Location: /index.php');
}
