<?php
	$dbname = 'databasedesign';
	$dbuser = 'root';
	$dbpass = 'admin';
	$dbhost = 'localhost';

	$link = mysqli_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysqli_select_db($link, $dbname) or die("Could not open the db '$dbname'");
	
	$sql = "INSERT INTO individual_forms (Class, Title, Authors, Edition, Publisher, ISBN) VALUES ('". $_POST['class']. "', '". $_POST['title']. "', '".$_POST['authors']."', ".$_POST['edition'].", '". $_POST['publisher']."', ".$_POST['isbn'].")";
	
	if(mysqli_query($link, $sql)) {
		echo "Added Book";
		?>
		<script>
		window.location.href='/viewform.php';
		</script>
	<?php
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($link);
	}
	
	mysqli_close($link);
?>	