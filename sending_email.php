<?php 
if (isset($_POST['sending_email_btn'])) {
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $emailSendMessage = $_POST['msg'];
  // Content-Type helps email client to parse file as HTML 
  // therefore retaining styles
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $message = "<html>
  <body>
  	<h1>" . $subject . "</h1>
  	<p>".nl2br($emailSendMessage)."</p>
  </body>
  </html>";
  if (mail($email, $subject, $message, $headers)) {
   echo "Email Sent Sucessfully to ". $email;
  }else{
   echo "Sorry, Failed to send email. Please try again later";
  }
}
?>