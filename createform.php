<?php
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
	
	$type = $_SESSION['type'];
	
	if($type === 'admin' || $type === 'super')
	{
		header("location: viewfaculty.php");
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
		View/Edit Forms
	</title>
<script>
	semesterData = [];
<?php
	$query="SELECT Semester FROM forms_list WHERE FacultyUsername = '".$_SESSION['username']."' ORDER BY FormID";
	$formsListResult=mysqli_query($link, $query);
	while($row=mysqli_fetch_array($formsListResult))
	{
?>
	semesterData.push("<?php echo $row['Semester'];?>");
<?php
	}
?>
</script>
<body>
<div class=flex-container style="width: 70%; text-align: center; margin-top:100px; padding:0px; padding-bottom:20px; margin:auto;">
<div id="navbar" style="display: flex; justify-content: space-between; width=100%; height=50px; margin-bottom:16px; background-color:black; color:gold; margin-top:0px;  text-align: left; ">
				<ul style="width:100%;">
					<li style="display:inline; margin-right:30px;"><i class="fas fa-user"></i>     <?php echo htmlspecialchars($_SESSION["username"]);echo htmlspecialchars($_SESSION["type"]); ?></li>
					
					<li id="viewform" style="display:inline; margin-right:30px;"><a href="viewform.php" style="color:white; text-decoration: underline;">View/Edit Form</a></li>
					<li id="createform" style="display:inline; margin-right:30px;"><a href="createform.php" style="color:white; text-decoration: underline;">Create Form</a></li>
					<li id="viewfaculty" style="display:inline; margin-right:30px;"><a href="viewfaculty.php" style="color:white; text-decoration: underline;">Manage Faculty</a></li>
					<li id="createfinal" style="display:inline; margin-right:30px;"><a href="createfinal.php" style="color:white; text-decoration: underline;">Final List</a></li>
					<li id="displayStore" style="display:inline; margin-right:30px;"><a href="display_store.php" style="color:white; text-decoration: underline;">Display Store</a></li>
					<li id="invitation" style="display:inline; margin-right:30px;"><a href="invitation.php" style="color:white; text-decoration: underline;">Account Invite</a></li>
					<li id="forgotLogin" style="display:inline; margin-right:30px;"><a href="forgot_login_resolution.php" style="color:white; text-decoration: underline;">Account Resolution</a></li>

					<li id="individualReminder" style="display:inline; margin-right:30px;"><a href="individual_deadline_reminder.php" style="color:white; text-decoration: underline;">Individual Reminder</a></li>
					<li id="broadcastReminder" style="display:inline; margin-right:30px;"><a href="broadcast_deadline_reminder.php" style="color:white; text-decoration: underline;">Broadcast Reminder</a></li>
				</ul>
				<ul>
				<li style="display:inline; "><a href="logout.php" class="btn btn-danger" style="border-radius:0; color:white !important;">Logout</a></li>
					
					<script>
					var type = "<?php echo $type ?>";
					if(type == "admin" || type == "super")
					{
						document.getElementById('viewform').style.display = 'none';
						document.getElementById('createform').style.display = 'none';
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
<h3 style="margin-top:16px; margin-bottom:16px;">Add Books</h3>
			

		<form method="post" id="form" action="submitForm.php">
			<div>
			<div id="formContent">
				<input type="hidden" name="class[]">
				<input type="hidden" name="title[]">
				<input type="hidden" name="authors[]">
				<input type="hidden" name="edition[]">
				<input type="hidden" name="publisher[]">
				<input type="hidden" name="isbn[]">
			</div>
				<input type="button" onClick="addBook()" value="Add Book">
			</div>
			
			
			<h3 style="margin-top: 16px; margin-bottom:16px;">Choose a Semester</h3>
			<select id="semester" name="semester">
				<option value="Fall">Fall</option>
				<option value="Spring">Spring</option>
				<option value="Summer">Summer</option>
			</select>
			<input id="year" type="number" placeholder="Year" name="year" max="3000" min="2021" value="2021">
			<button type="button" id="checksemesterbutton" onclick="checkSemester()">Check If Semester Already Exists</button>
			<input type="submit" id="submitbutton" value="Submit" style="display:none">
			<h2 id="semesterexists" style="display: none;">Semester Already Exists</h2>
		</form>
			<script>
				var semesterDropdown = document.getElementById('semester');
				var yearSelect = document.getElementById('year');
				
				semesterDropdown.addEventListener('change',function(){
					document.getElementById('checksemesterbutton').style.display = 'revert';
					document.getElementById('semesterexists').style.display = 'none';
					document.getElementById('submitbutton').style.display = 'none';
				});
			
				year.addEventListener('change', function(){
					document.getElementById('checksemesterbutton').style.display = 'revert';
					document.getElementById('semesterexists').style.display = 'none';
					document.getElementById('submitbutton').style.display = 'none';
				});
			
				function checkSemester(){
					var semesterPos = semesterDropdown.selectedIndex;
					var semesterName = semesterDropdown.options[semesterPos].value;
					var semesterYear = document.getElementById('year').value;
					var inputSemester = semesterName+semesterYear;
					if(semesterData.indexOf(inputSemester) === -1)
					{
						document.getElementById('checksemesterbutton').style.display = 'none';
						document.getElementById('semesterexists').style.display = 'none';
						document.getElementById('submitbutton').style.display = 'revert';
					}
					else
					{
						document.getElementById('semesterexists').style.display = 'revert';
					}
				}
			
				function addBook(){
					var div = document.createElement("div");
					var classCell = document.createElement("input");
					var titleCell = document.createElement("input");
					var authorsCell = document.createElement("input");
					var editionCell = document.createElement("input");
					var publisherCell = document.createElement("input");
					var isbnCell = document.createElement("input");
					
					classCell.setAttribute('type', 'text');
					titleCell.setAttribute('type', 'text');
					authorsCell.setAttribute('type', 'text'); 
					editionCell.setAttribute('type', 'number'); 
					publisherCell.setAttribute('type', 'text');
					isbnCell.setAttribute('type', 'number');
					
					classCell.setAttribute('placeholder', 'Class');
					titleCell.setAttribute('placeholder', 'Title');
					authorsCell.setAttribute('placeholder', 'Authors');
					editionCell.setAttribute('placeholder', 'Edition');
					publisherCell.setAttribute('placeholder', 'Publisher');
					isbnCell.setAttribute('placeholder', 'ISBN');
					
					classCell.required = true;
					titleCell.required = true;
					authorsCell.required = true;
					editionCell.required = true;
					publisherCell.required = true;
					isbnCell.required = true;
					
					classCell.name = "class[]";
					titleCell.name = "title[]";
					authorsCell.name = "authors[]";
					editionCell.name = "edition[]";
					publisherCell.name = "publisher[]";
					isbnCell.name = "isbn[]";
					
					document.getElementById("formContent").appendChild(div);
					
					div.appendChild(classCell);
					div.appendChild(titleCell);
					div.appendChild(authorsCell);
					div.appendChild(editionCell);
					div.appendChild(publisherCell);
					div.appendChild(isbnCell);
				}
			</script>
			</div>
			
			</body>
			</html>