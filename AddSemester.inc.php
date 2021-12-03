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
		echo "Form Already Exists";
		$formidqueryresult = mysqli_query($link, $formidquery);
		
		while($formid = mysqli_fetch_array($formidqueryresult)){
			header("location: ../viewform.php?semester=".$formid['FormID']);
			exit();
		}
		exit();
	}
	else if(mysqli_query($link, $sql)){
		echo "Added Form";
		$formidqueryresult = mysqli_query($link, $formidquery);
		
		while($formid = mysqli_fetch_array($formidqueryresult)){
			header("location: ../viewform.php?semester=".$formid['FormID']);
			exit();
		}
	}
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);
?>	