<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Account Invitation</title>
   
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

$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "dbsproject";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>

<center>

<h2>Account Invitation</h2>

<br /><br /><br /><br />

<div id="email_notification_box">
<form method="post" action="sending_email.php">

<b>Email:</b> 
<br />
<select name="email">
<?php

$sql = "SELECT Email FROM faculty 
	UNION
	SELECT Email FROM admin";
$result = $conn->query($sql);

while($rows = $result->fetch_assoc()) {
    $Email = $rows['Email'];
    echo "<option value='$Email'>$Email</option>";
}

?>
</select>

<br /><br />
<b>Subject:</b> 
<br />
<input type="text" style="width:220x"; name="subject" value="Bookstore Account Invitation" readonly="readonly">
<br /><br />
<b>Message:</b> 
<br />
<textarea name="msg" style="width:340px; ;height:230px;">
Welcome!

You now have an account created with the Bookstore.

Use the following Username and Password to login into your account.

Username: XXXXX <-- Fill in.
Password: XXXXX <-- Fill in.

Sincerely,

Bookstore Staff
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