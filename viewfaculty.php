<?php
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	
	include 'db.php';
	$link = connect();
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
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
		<dir class=flex-container style="border-style: solid; border-color:gray; width: 60%; text-align: center; margin: auto; padding: 2%;">
			<h2>Manage Faculty</h2>
			<h3 style="text-align:right">Log Out</h3>
			<table align="center" id="table">
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Password</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</table>
			
			<h3>Add New Faculty</h3>
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
	</body>
</html>
	