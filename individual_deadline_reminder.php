   <?php
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	$type = $_SESSION['type'];
	if($type === 'faculty')
	{
		header("location: viewform.php");
		exit;
	}
	
	include 'db.php';
	$conn = connect();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Individual Deadline Reminder</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/45b7647cee.js" crossorigin="anonymous"></script>
   
  <style>

a:hover {
  		color: gold !important;
	}
  	#email_notification_box {
  		border: 4px solid gold;
  		margin-left:25%;
		margin-right:25%;
		padding-top: 25px;
		padding-bottom: 25px;
		background-color: white;
		color: black;
		margin-top:-84px;
  	}
	body {
		background-color:black;
		color:gold;
	}
	#links a{
  		border: 5px solid gold;
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

	<div id="navbar" style="display: flex; justify-content: space-between; width=100%; height=50px; margin-bottom:16px; background-color:black; color:gold; margin-top:0px;  text-align: left; ">
		<ul style="width:100%;">
			<li style="display:inline; margin-right:30px;"><i class="fas fa-user"></i>     <?php echo htmlspecialchars($_SESSION["username"]);echo htmlspecialchars($_SESSION["type"]); ?></li>
		
			<li id="viewform" style="display:inline; margin-right:30px;"><a href="viewform.php" style="color:white; text-decoration: underline;">View/Edit Form</a></li>
			<li id="viewfaculty" style="display:inline; margin-right:30px;"><a href="viewfaculty.php" style="color:white; text-decoration: underline;">Manage Faculty</a></li>
			<li id="createfinal" style="display:inline; margin-right:30px;"><a href="createfinal.php" style="color:white; text-decoration: underline;">Final List</a></li>
			<li id="displayStore" style="display:inline; margin-right:30px;"><a href="display_store.php" style="color:white; text-decoration: underline;">Display Store</a></li>
			<li id="invitation" style="display:inline; margin-right:30px;"><a href="invitation.php" style="color:white; text-decoration: underline;">Account Invite</a></li>
			<li id="forgotLogin" style="display:inline; margin-right:30px;"><a href="forgot_login_resolution.php" style="color:white; text-decoration: underline;">Account Resolution</a></li>

			<li id="individualReminder" style="display:inline; margin-right:30px;"><a href="individual_deadline_reminder.php" style="color:white; text-decoration: underline;">Individual Reminder</a></li>
			<li id="broadcastReminder" style="display:inline; margin-right:30px;"><a href="broadcast_deadline_reminder.php?page=individual_deadline_reminder" style="color:white; text-decoration: underline;">Broadcast Reminder</a></li>
		</ul>
		<ul>
		<li style="display:inline; margin-right: 30px;"><a href="logout.php" class="btn btn-danger" style="border-radius:0; color:white !important;">Logout</a></li>
			
		<script>
			var type = <?php echo json_encode($type) ?>;
			if(type == "admin" || type == "super")
			{
				document.getElementById('viewform').style.display = 'none';
				document.getElementById('createfinal').style.display = 'none';
			}
			else
			{
				document.getElementById('viewfaculty').style.display = 'none';
				document.getElementById('displayStore').style.display = 'none';
				document.getElementById('invitation').style.display = 'none';
				document.getElementById('forgotLogin').style.display = 'none';
				document.getElementById('individualReminder').style.display = 'none';
				document.getElementById('broadcastReminder').style.display = 'none';
			}
		</script>
		</ul>

	</div>
<center>

<h2>Individual Deadline Reminder</h2>

<br /><br /><br /><br />

<div id="email_notification_box">
<form method="post" action="sending_email.php">

<b>Email:</b> 
<br />
<select name="email">
<?php

$sql = "SELECT Email FROM faculty";
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
<input type="text" style="width:240px"; name="subject" value="Individual Deadline Reminder" readonly="readonly">
<br /><br />
<b>Message:</b> 
<br />
<textarea name="msg" style="width:400px; ;height:180px;">
This is an individual reminder to please put in your book order by 01/08/2022.

Sincerely,

Bookstore Staff
</textarea>
<br />
<button type="submit" name="sending_email_btn">Send</button>

</form>
</div

<div id = "links">
</div>
</center>
<img src="./ucf-l.png" alt="UCF" style=" width:160px; height:160px; display:block; margin-left: 45.85%; position: relitive; margin-top:28px;">

</body>
</html>