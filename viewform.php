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
		<dir class=flex-container style="border-style: solid; border-color:gray; width: 60%; text-align: center; margin: auto; padding: 2%;">
			<h2>View/Edit Form</h2>
			<h3 style="text-align:right">Log Out</h3>
			<select id="SemesterSelection">
			</select>
			<table align="center" id="table">
				<tr>
					<th>Class</th>
					<th>Title</th>
					<th>Authors</th>
					<th>Edition</th>
					<th>Publisher</th>
					<th>ISBN</th>
					<th>BookID</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</table>
			
			<h3>Add New Book</h3>
			<form method="post" name = "form" action="insert.php">
				<input type="text" placeholder="Class" name="class" required>
				<input type="text" placeholder="Title" name="title" required>
				<input type="text" placeholder="Authors" name="authors" required>
				<input type="number" placeholder="Edition" name="edition" required>
				<input type="text" placeholder="Publisher" name="publisher" required>
				<input type="number" placeholder="ISBN" name="isbn" required>
				<input type="hidden" name="formid" id="formidfield" required>
				<input type="submit" value="Submit">
			</form>
			
			<h3>Add New Semester</h3>
			<form method="post" name = "addSemesterForm" action="AddSemester.inc.php">
				<select id="semester" name="semester">
					<option value="Fall">Fall</option>
					<option value="Spring">Spring</option>
					<option value="Summer">Summer</option>
				</select>
				<input type="number" placeholder="Year" name="year" max="3000" min="2021" value="2021">
				<input type="submit" value="Submit">
			</form>
			
			<script>
				var semesterDropdown = document.getElementById("SemesterSelection");
				//populates the dropdown menu
				for(i = 0; i < semesterData.length; i++)
				{
					var currentOption = document.createElement('option');
					currentOption.text = semesterData[i][0];
					currentOption.value = semesterData[i][1];
					semesterDropdown.add(currentOption);
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
				document.getElementById("formidfield").value = currentSemester;
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
						document.getElementById("formidfield").value = currentSemester;
					}
				});
			</script>
		</dir>
	</body>
</html>
	