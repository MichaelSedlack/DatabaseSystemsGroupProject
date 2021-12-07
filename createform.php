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