<?php
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

	include 'db.php';
	$link = connect();
		
	$sql = "INSERT INTO forms_list (FacultyUsername, Semester) VALUES ('". $_SESSION['username']. "', '". $_POST['semester'].$_POST['year']. "')";
	
	$formidquery = "SELECT FormID FROM forms_list WHERE FacultyUsername = '".$_SESSION['username']."' AND Semester = '".$_POST['semester'].$_POST['year']."'";
	
	if(mysqli_query($link, $formidquery)->num_rows != 0) {
		header("location: ./viewform.php");
	}
	mysqli_query($link, $sql);
	if(mysqli_query($link, $formidquery)) {
		
		$formidqueryresult = mysqli_query($link, $formidquery);
		while($formidqueryresult = mysqli_fetch_array($formidqueryresult)){
			$formId = $formidqueryresult['FormID'];
		}
		$arrayLength = count($_POST['class']);
		for($i = 1; $i < $arrayLength; $i++)
		{
			$sql = "INSERT INTO individual_forms (Class, Title, Authors, Edition, Publisher, ISBN, FormID) VALUES ('". $_POST['class'][$i]. "', '". $_POST['title'][$i]. "', '".$_POST['authors'][$i]."', ".$_POST['edition'][$i].", '". $_POST['publisher'][$i]."', ".$_POST['isbn'][$i].", ".$formId.")";
			if(mysqli_query($link, $sql)) {
				echo "Added Book";
			}
			else {
				echo "Error: " . $sql . "<br>" . mysqli_error($link);
			}
		}
		header("location: ../viewform.php?semester=".$formId);
		exit();
	}
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);
?>	