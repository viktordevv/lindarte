<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  require 'sendgrid-php/sendgrid-php.php';

  // Recopilar información del formulario
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $message = $_POST["message"];

  $email = new \SendGrid\Mail\Mail(); 
  $email->setFrom($email, $name);
  $email->setSubject("New Contact Form Submission");
  $email->addTo("pvt.vik@gmail.com", "Lindarte Contractor");
  $email->addContent(
    "text/plain", "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message"
  );

  $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
  try {
    $response = $sendgrid->send($email);
    echo "Message sent!";
  } catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
  }
}
?>
