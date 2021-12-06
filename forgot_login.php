<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forgot Account Info</title>
   
  <style>
  	#email_notification_box {
  		border: 5px solid yellow;
  		margin-left:25%;
		margin-right:25%;
		padding-top: 25px;
		padding-bottom: 25px;
		background-color: white;
		color: black;
  	}
	body {
		background-color:black;
		color:yellow;
	}
	#links a{
  		border: 5px solid yellow;
		padding-left:10px;
		padding-right:10px;
		padding-top:10px;
		padding-bottom:10px;	
		color: white;
  	}
  </style>
</head>


</head>

<body>

<?php

include 'db.php';

// Create connection
$conn = connect();

?>

<center>

<h2>Forgot Account Info</h2>

<br /><br /><br /><br />

<div id="email_notification_box">
<form method="post" action="sending_email.php">

<b>User email:</b>
<br />
<input type="email" name="email" value="mitchellswise@gmail.com" readonly="readonly">
<br /><br />
<b>Subject:</b> 
<br />
<input type="text" style="width:220x"; name="subject" value="Forgot Account Info" readonly="readonly">
<br /><br />
<b>Message:</b> 
<br />
<textarea name="msg" style="width:340px; ;height:120px;">
Bookstore Staff,

I forgot my login info for my account.

Email: XXXXX <-- Fill in.
</textarea>
<br />
<button type="submit" name="sending_email_btn">Send</button>

</form>
</div
<br /><br />
<div id = "links">
<h4><a href="index.php">Back</a><h4>
</div>
</center>

</body>
</html>