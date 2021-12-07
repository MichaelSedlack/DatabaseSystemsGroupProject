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
<html>
	<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/45b7647cee.js" crossorigin="anonymous"></script>

	<style>

	body {background-color:black; margin-top:50px;}

	.flex-container{z-index:1; background-color:white; border: 4px solid gold;}
	
	a:hover {
  		color: gold !important;
	}

  	</style>


	</head>
	<title>
		Manage Faculty
	</title>
	
	
	<script>
		//creates a series of arrays that contain all of the data of the table for future reference
		var firstnameData = [];
		var lastnameData = [];
		var usernameData = [];
		var emailData = [];
		var passwordData = [];
		i = 0;
		//populates the semester data array with which semester each FormID is associated with, this is done by having the array pos == FormID
		
		<?php
			$query="SELECT * FROM faculty";
			$result=mysqli_query($link, $query);
			while($rows=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
		?>
		
		firstnameData.push("<?php echo $rows['FirstName']; ?>");
		lastnameData.push("<?php echo $rows['LastName']; ?>");
		usernameData.push("<?php echo $rows['FacultyUsername']; ?>");
		emailData.push("<?php echo $rows['Email']; ?>");
		passwordData.push("<?php echo $rows['Password']; ?>");
		<?php
			};
		?>
	
		function resetTable() {
			//emptys the table before filling it with new data
			var table = document.getElementById("table");
			var table_length = (table.rows.length)-1;
			for(var n = 0; n < table_length; n++)
			{
				table.deleteRow(1);
			}
		}
		
		function populateTable(){
			for(var n = 0; n < firstnameData.length; n++)
			{
				var row = table.insertRow(table.rows.length);
				var firstnameCell = row.insertCell(0);
				var lastnameCell = row.insertCell(1);
				var usernameCell = row.insertCell(2);
				var emailCell = row.insertCell(3);
				var passwordCell = row.insertCell(4);
				var editCell = row.insertCell(5);
				var deleteCell = row.insertCell(6);
				
				firstnameCell.innerHTML = firstnameData[n];
				firstnameCell.contentEditable = false;
				lastnameCell.innerHTML = lastnameData[n];
				lastnameCell.contentEditable = false;
				usernameCell.innerHTML = usernameData[n];
				usernameCell.contentEditable = false;
				emailCell.innerHTML = emailData[n];
				emailCell.contentEditable = false;
				passwordCell.innerHTML = passwordData[n];
				passwordCell.contentEditable = false;
				editCell.innerHTML = 'Edit';
				editCell.className = 'clickableText';
				editCell.onclick = function(){editRow(this.parentElement);};
				deleteCell.innerHTML = 'Delete';
				deleteCell.className = 'clickableText';
				deleteCell.onclick = function(){deleteRow(this.parentElement);};
			}
		}
		
		function editRow(selectedRow) {
			console.log(selectedRow.cells[0].isContentEditable == false);
			//Grabs the data from the cells and changes them to text inputs
			var firstnameCell = selectedRow.cells[0];
			var lastnameCell = selectedRow.cells[1];
			var usernameCell = selectedRow.cells[2];
			var emailCell = selectedRow.cells[3];
			var passwordCell = selectedRow.cells[4];
			var editCell = selectedRow.cells[5];
			
			if(firstnameCell.isContentEditable == false)
			{
				firstnameCell.contentEditable = true;
				lastnameCell.contentEditable = true;
				emailCell.contentEditable = true;
				passwordCell.contentEditable = true;
				editCell.innerHTML = "Save";
			}
			else
			{
				if(firstnameCell.innerHTML == null || firstnameCell.innerHTML === "<br>" || lastnameCell.innerHTML == null || lastnameCell.innerHTML === "<br>" || usernameCell.innerHTML == null || usernameCell.innerHTML === "<br>" || emailCell.innerHTML == null || emailCell.innerHTML === "<br>" || passwordCell.innerHTML == null || passwordCell.innerHTML === "<br>")
				{
					alert("All fields must be filled to add or edit a book");
				}
				else {
					firstnameCell.contentEditable = false;
					lastnameCell.contentEditable = false;
					emailCell.contentEditable = false;
					passwordCell.contentEditable = false;
					editCell.innerHTML = "Edit";
					window.location.href="/EditFaculty.inc.php?firstname="+selectedRow.cells[0].innerHTML+"&lastname="+selectedRow.cells[1].innerHTML+"&username="+selectedRow.cells[2].innerHTML+"&email="+selectedRow.cells[3].innerHTML+"&password="+selectedRow.cells[4].innerHTML;
				}
			}
			
		}
		
		function deleteRow(selectedRow) {
			console.log(selectedRow);
			console.log('delete');
			window.location.href="/DeleteFaculty.inc.php?username="+selectedRow.cells[2].innerHTML;
			//table.deleteRow(selectedRow.rowIndex);
		}
		
		function addRow() {
			var row = table.insertRow(table.rows.length);
			var firstnameCell = row.insertCell(0);
			var lastnameCell = row.insertCell(1);
			var usernameCell = row.insertCell(2);
			var emailCell = row.insertCell(3);
			var passwordCell = row.insertCell(4);
			var editCell = row.insertCell(7);
			var deleteCell = row.insertCell(8);
			
			firstnameCell.contentEditable = true;
			lastnameCell.contentEditable = true;
			usernameCell.contentEditable = true;
			emailCell.contentEditable = true;
			passwordCell.contentEditable = true;
			editCell.contentEditable = false;
			deleteCell.contentEditable = false;
			
			editCell.innerHTML = 'Edit';
			editCell.className = 'clickableText';
			editCell.onclick = function(){editRow(this.parentElement);};
			deleteCell.innerHTML = 'Delete';
			deleteCell.className = 'clickableText';
			deleteCell.onclick = function(){deleteRow(this.parentElement);};
		}
	</script>
	<body>
		<div class=flex-container style="width: 80%; text-align: center; margin-top:100px; padding:0px; padding-bottom:0px; margin:auto;">
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
					<li id="broadcastReminder" style="display:inline; margin-right:30px;"><a href="broadcast_deadline_reminder.php?page=viewfaculty" style="color:white; text-decoration: underline;">Broadcast Reminder</a></li>
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
			<h2 style="margin-bottom:32px;">Manage Faculty</h2>
			<table style="width:67.5%; margin-left:250px; margin-top: 25px;"id="table">
				<tr style="border-bottom:1px solid black;">
					<th><h6 style="margin-top:-20px;">First Name</h6></th>
					<th><h6 style="margin-top:-20px;">Last Name</h6></th>
					<th><h6 style="margin-top:-20px;">Username</h6></th>
					<th><h6 style="margin-top:-20px;">Email</h6></th>
					<th><h6 style="margin-top:-20px;">Password</h6></th>
					<th><h6 style="margin-top:-20px;">Edit</h6></th>
					<th><h6 style="margin-top:-20px;">Delete</h6></th>
				</tr>
			</table>
			
			<h3 style="margin-top:16px; margin-bottom:16px;">Add New Faculty</h3>
			<form method="post" name = "form" action="insertFaculty.php">
				<input type="text" placeholder="First Name" name="firstname" required>
				<input type="text" placeholder="Last Name" name="lastname" required>
				<input type="text" placeholder="Username" name="username" required>
				<input type="text" placeholder="Email" name="email" required>
				<input type="text" placeholder="Password" name="password" required>
				<input type="submit" value="Submit">
			</form>
			
			<br>
			<script>
				populateTable();
			</script>
		</dir>
<img src="./ucf-l.png" alt="UCF" style=" width:160px; height:160px; display:block; margin-left: 46%; position: relitive; margin-top:50px;">
	</body>
</html>
	