<?php
	function connect() {
		$servername='localhost';
		$username='root';
		$password='admin';
		$dbname = "databasedesign";
		$conn=mysqli_connect($servername,$username,$password,"$dbname");
		if(!$conn){
		  die('Could not Connect MySql Server:' .mysql_error());
		}
		
		return $conn;
	}
?>