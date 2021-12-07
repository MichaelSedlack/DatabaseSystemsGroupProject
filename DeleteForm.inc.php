<?php
	session_start();
	
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

	if($type === 'admin' || $type === 'super')
	{
		header("location: viewfaculty.php");
		exit;
	}

	include 'db.php';
	$link = connect();
		
	$sql = "DELETE FROM individual_forms WHERE FormID = " .$_GET['FormID'];
	if(mysqli_query($link, $sql)){
		$sql = "DELETE FROM forms_list WHERE FormID = " .$_GET['FormID'];
		if(mysqli_query($link, $sql)){
			echo "Form Reset";
			header("location: ../viewform.php");
			exit();
		}
	}
	else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	mysqli_close($link);
?>	