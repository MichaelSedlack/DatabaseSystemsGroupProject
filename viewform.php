<?php
	$dbname = 'databasedesign';
	$dbuser = 'root';
	$dbpass = 'admin';
	$dbhost = 'localhost';

	$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="style.css">-->
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
		
		//populates the semester data array with which semester each FormID is associated with, this is done by having the array pos == FormID
		<?php
			$query="SELECT Semester FROM forms_list ORDER BY FormID";
			$formsListResult=mysqli_query($link, $query);
			while($row=mysqli_fetch_array($formsListResult))
			{
		?>
			semesterData.push("<?php echo $row['Semester'];?>");
		<?php
			}
		?>
		
		console.log(semesterData);
		
		
		
		<?php
			$query="SELECT * FROM individual_forms ORDER BY FormID";
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
			for(var n = 0; n < classData.length; n++)
			{
				console.log(Semester);
				console.log(semesterData[formidData[n]]);
				console.log(Semester===semesterData[formidData[n]]);
				if(semesterData[formidData[n]]===Semester)
				{
					var row = table.insertRow(table.rows.length);
					var classCell = row.insertCell(0);
					var titleCell = row.insertCell(1);
					var authorsCell = row.insertCell(2);
					var editionCell = row.insertCell(3);
					var publisherCell = row.insertCell(4);
					var isbnCell = row.insertCell(5);
					
					classCell.innerHTML = classData[n];
					titleCell.innerHTML = titleData[n];
					authorsCell.innerHTML = authorsData[n];
					editionCell.innerHTML = editionData[n];
					publisherCell.innerHTML = publisherData[n];
				}
			}
		}
	</script>
	<body>
		<dir class=flex-container style="border-style: solid; border-color:gray; width: 60%; text-align: center; margin: auto">
			<h2>View/Edit Form</h2>
			<h3 style="text-align:right">Log Out</h3>
			<select id="SemesterSelection">
				<?php
					$query="select distinct Semester from forms_list";
					$formsListResult=mysqli_query($link, $query);
					while($row=mysqli_fetch_array($formsListResult))
					{
				?>
				<option value=<?php echo $row['Semester']?>><?php echo $row['Semester']?></option>
				<?php
					}
				?>
			</select>
			<script>
				var semesterDropdown = document.getElementById("SemesterSelection");
				
				//grabs the first available semester option t display it in the table
				var selectedPos = semesterDropdown.selectedIndex;
				var currentSemester = semesterDropdown.options[selectedPos].text;
				console.log(currentSemester);
				
				//updates the table every time that a new selection is chosen from the dropdown menu
				semesterDropdown.addEventListener('change',function(){
					var selectedPos = semesterDropdown.selectedIndex;
					var currentSemester = semesterDropdown.options[selectedPos].text;
					resetTable();
					populateTable(currentSemester);
				});
			</script>
			<table align="center" id="table">
				<tr>
					<th>Class</th>
					<th>Title</th>
					<th>Authors</th>
					<th>Edition</th>
					<th>Publisher</th>
					<th>ISBN</th>
				</tr>
				<script>
					populateTable(currentSemester);
				</script>
			</table>
		</dir>
	</body>
</html>
	