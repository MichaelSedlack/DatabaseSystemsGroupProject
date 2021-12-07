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
		//creates a series of arrays that contain all of the data of the table for future reference
		var classData = [];
		var titleData = [];
		var authorsData = [];
		var editionData = [];
		var publisherData = [];
		var isbnData = [];
		var formidData = [];
		var semesterData = [];
		var bookidData = [];
		i = 0;
		//populates the semester data array with which semester each FormID is associated with, this is done by having the array pos == FormID
		<?php
			$query="SELECT Semester, FormID FROM forms_list WHERE FacultyUsername = '".$_SESSION['username']."' ORDER BY FormID";
			$formsListResult=mysqli_query($link, $query);
			while($row=mysqli_fetch_array($formsListResult))
			{
		?>
			semesterData[i] = [];
			semesterData[i].push("<?php echo $row['Semester'];?>");
			semesterData[i].push("<?php echo $row['FormID'];?>");
			i++;
		<?php
			}
		?>
		
		console.log(semesterData);
		
		
		
		<?php
			$query="SELECT * FROM individual_forms WHERE FormID IN (SELECT FormID FROM forms_list WHERE FacultyUsername = '".$_SESSION["username"]."') ORDER BY FormID";
			$result=mysqli_query($link, $query);
			while($rows=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
		?>
		
				classData.push("<?php echo $rows['Class']; ?>");
				titleData.push("<?php echo $rows['Title']; ?>");
				authorsData.push("<?php echo $rows['Authors']; ?>");
				editionData.push("<?php echo $rows['Edition']; ?>");
				publisherData.push("<?php echo $rows['Publisher']; ?>");
				isbnData.push("<?php echo $rows['ISBN']; ?>");
				formidData.push("<?php echo $rows['FormID'];?>");
				bookidData.push("<?php echo $rows['BookID'];?>");
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
		
		function populateTable(Semester){
			console.log(Semester);
			for(var n = 0; n < classData.length; n++)
			{
				if(formidData[n]===Semester)
				{
					var row = table.insertRow(table.rows.length);
					var classCell = row.insertCell(0);
					var titleCell = row.insertCell(1);
					var authorsCell = row.insertCell(2);
					var editionCell = row.insertCell(3);
					var publisherCell = row.insertCell(4);
					var isbnCell = row.insertCell(5);
					var bookidCell = row.insertCell(6);
					var editCell = row.insertCell(7);
					var deleteCell = row.insertCell(8);
					
					classCell.innerHTML = classData[n];
					classCell.contentEditable = false;
					titleCell.innerHTML = titleData[n];
					titleCell.contentEditable = false;
					authorsCell.innerHTML = authorsData[n];
					authorsCell.contentEditable = false;
					editionCell.innerHTML = editionData[n];
					editionCell.contentEditable = false;
					publisherCell.innerHTML = publisherData[n];
					publisherCell.contentEditable = false;
					isbnCell.innerHTML = isbnData[n];
					isbnCell.contentEditable = false;
					bookidCell.innerHTML = bookidData[n];
					bookidCell.contentEditable
					bookidCell.style.display = 'none';
					editCell.innerHTML = 'Edit';
					editCell.className = 'clickableText';
					editCell.onclick = function(){editRow(this.parentElement);};
					deleteCell.innerHTML = 'Delete';
					deleteCell.className = 'clickableText';
					deleteCell.onclick = function(){deleteRow(this.parentElement);};
				}
			}
		}
		
		function editRow(selectedRow) {
			console.log(selectedRow.cells[0].isContentEditable == false);
			//Grabs the data from the cells and changes them to text inputs
			var classCell = selectedRow.cells[0];
			var titleCell = selectedRow.cells[1];
			var authorsCell = selectedRow.cells[2];
			var editionCell = selectedRow.cells[3];
			var publisherCell = selectedRow.cells[4];
			var isbnCell = selectedRow.cells[5];
			var editCell = selectedRow.cells[7];
			
			if(titleCell.isContentEditable == false)
			{
				classCell.contentEditable = true;
				titleCell.contentEditable = true;
				authorsCell.contentEditable = true;
				editionCell.contentEditable = true;
				publisherCell.contentEditable = true;
				isbnCell.contentEditable = true;
				editCell.innerHTML = "Save";
			}
			else
			{
				console.log("innerHTML === '<br>'");
				console.log(classCell.innerHTML === "<br>");
				console.log("");
				if(classCell.innerHTML == null || classCell.innerHTML === "<br>" || titleCell.innerHTML == null || titleCell.innerHTML === "<br>" || authorsCell.innerHTML == null || authorsCell.innerHTML === "<br>" || editionCell.innerHTML == null || editionCell.innerHTML === "<br>" || publisherCell.innerHTML == null || publisherCell.innerHTML === "<br>" || isbnCell.innerHTML == null || isbnCell.innerHTML === "<br>")
				{
					alert("All fields must be filled to add or edit a book");
				}
				else {
					classCell.contentEditable = false;
					titleCell.contentEditable = false;
					authorsCell.contentEditable = false;
					editionCell.contentEditable = false;
					publisherCell.contentEditable = false;
					isbnCell.contentEditable = false;
					editCell.innerHTML = "Edit";
					window.location.href="/EditBook.inc.php?id="+selectedRow.cells[6].innerHTML+"&class="+selectedRow.cells[0].innerHTML+"&title="+selectedRow.cells[1].innerHTML+"&authors="+selectedRow.cells[2].innerHTML+"&edition="+selectedRow.cells[3].innerHTML+"&publisher="+selectedRow.cells[4].innerHTML+"&isbn="+selectedRow.cells[5].innerHTML+"&semester="+currentSemester;
				}
			}
			
		}
		
		function deleteRow(selectedRow) {
			console.log(selectedRow);
			console.log('delete');
			window.location.href="/DeleteBook.inc.php?id="+selectedRow.cells[6].innerHTML+"&semester="+currentSemester;
			//table.deleteRow(selectedRow.rowIndex);
		}
		
		function addRow() {
			var row = table.insertRow(table.rows.length);
			var classCell = row.insertCell(0);
			var titleCell = row.insertCell(1);
			var authorsCell = row.insertCell(2);
			var editionCell = row.insertCell(3);
			var publisherCell = row.insertCell(4);
			var isbnCell = row.insertCell(5);
			var bookidCell = row.insertCell(6);
			var editCell = row.insertCell(7);
			var deleteCell = row.insertCell(8);
			
			classCell.contentEditable = true;
			titleCell.contentEditable = true;
			authorsCell.contentEditable = true;
			editionCell.contentEditable = true;
			publisherCell.contentEditable = true;
			isbnCell.contentEditable = true;
			bookidCell.contentEditable = false;
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

			<div id="viewformssection">
				<h2 style="margin-bottom: 16px;">View/Edit Form</h2>
				<select id="SemesterSelection" style="margin-bottom:16px;">
				</select>
				<table id="table" style="width:80.3%; margin-left:150px; margin-top: 25px;">
					<tr style="border-bottom:1px solid black;">
						<th><h6 style="margin-top:-20px;">Class</h6></th>
						<th><h6 style="margin-top:-20px;">Title</h6></th>
						<th><h6 style="margin-top:-20px;">Authors</h6></th>
						<th><h6 style="margin-top:-20px;">Edition</h6></th>
						<th><h6 style="margin-top:-20px;">Publisher</h6></th>
						<th><h6 style="margin-top:-20px;">ISBN</h6></th>
					</tr>
				</table>
				
				<form method="post" name = "form" action="insert.php">
				<input type="text" placeholder="Class" name="class">
				<input type="text" placeholder="Title" name="title">
				<input type="text" placeholder="Authors" name="authors">
				<input type="number" placeholder="Edition" name="edition">
				<input type="text" placeholder="Publisher" name="publisher">
				<input type="number" placeholder="ISBN" name="isbn">
				<input type="hidden" name="formid" id="formidfield">
				<input type="submit" value="Submit">
			</form>
				
				<button type="button" onclick="deleteForm()">Delete Form</button>
			</div>
			<div class="createformsection">
				<button type="button" onclick=window.location.href="/CreateForm.php">Create New Form</button>
			</div>
			<script>
				function deleteForm()
				{
					if(confirm("Are you sure you want to delete this form? It will delete all the books associated with it and cannot be undone")) 
					{
						window.location.href="/DeleteForm.inc.php?FormID="+currentSemester;
					}
				}
				
			
				var semesterDropdown = document.getElementById("SemesterSelection");
				
				//populates the dropdown menu
				for(i = 0; i < semesterData.length; i++)
				{
					var currentOption = document.createElement('option');
					currentOption.text = semesterData[i][0];
					currentOption.value = semesterData[i][1];
					semesterDropdown.add(currentOption);
				}
				
				//if the semesterdropdown is empty, hides all the contents of view/edit form and replaces with a link to create form
				if(semesterData.length == 0)
				{
					document.getElementById("viewformssection").style.display = 'none';
				}
				
				<?php
					if(isset($_GET['semester']) && !empty($_GET['semester']))
					{
						echo "semesterDropdown.value=".$_GET['semester'];
					}
				?>
					
				//grabs the first available semester option t display it in the table
				var selectedPos = semesterDropdown.selectedIndex;
				var currentSemester = semesterDropdown.options[selectedPos].value;
				populateTable(currentSemester);
				
				//updates the table every time that a new selection is chosen from the dropdown menu
				semesterDropdown.addEventListener('change',function(){
					var selectedPos = semesterDropdown.selectedIndex;
					currentSemester = semesterDropdown.options[selectedPos].value;
					resetTable();
					if(currentSemester == 'addSemester')
					{
						window.location.href="/AddSemester.inc.php";
					}
					else
					{
						populateTable(currentSemester);
					}
				});
			</script>
			
		</div>
	<img src="./ucf-l.png" alt="UCF" style=" width:160px; height:160px; display:block; margin-left: 46%; position: relitive; margin-top:50px;">
	</body>
</html>
	