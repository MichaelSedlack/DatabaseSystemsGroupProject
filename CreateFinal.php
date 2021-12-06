<?php
	session_start();
	include 'db.php';
	$link = connect();
?>
<!DOCTYPE html>
<html lang = 'en'>
<head>
  <meta charset="utf-8">
  <title>Final List></title>
  <style>
    body{
      background-color: whitesmoke;
    }
    input{
      width: 40%;
      height: 5%;
      border: 1px;
      border-radius: 05px;
      padding: 8px;
    }
  </style>
</head>
<body>
  <center>
  <h1>Create Final List</h1>
  <form action="search.php" method="POST">
    Please enter your Username<br>
    <input type="hidden" name="Username" placeholder="Username" value=<?php echo $_SESSION['username']?>>
    <br>
    <select name="Semester">
		<?php
			$query="SELECT Semester FROM forms_list WHERE FacultyUsername = '".$_SESSION['username']."'";
			$result=mysqli_query($link, $query);
			while($rows=mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
		?>
			<option value=<?php echo $rows['Semester'] ?>><?php echo $rows['Semester'] ?></option>
		<?php
			}
		?>
	</select>
    <br>
    <input type="submit" name='search'>
  </form>

</center>
</body>
</html>
