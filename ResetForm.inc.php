<?php
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

	include 'db.php';
	$link = connect();
		
	$sql = "DELETE FROM individual_forms WHERE FormID = " .$_GET['FormID'];
	if(mysqli_query($link, $sql)){
		echo "Form Reset";
		header("location: ../viewform.php?semester=".$_GET['FormID']);
		exit();
	}
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);
?>	