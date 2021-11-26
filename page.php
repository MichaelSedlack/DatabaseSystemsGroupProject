<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
</head>
<body>

<h2>Admin Table</h2>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "books";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT AdminUsername, Email, Name, Password FROM admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<b>AdminUsername:</b> ". $row["AdminUsername"]. "<br>". " <b>Email:</b> ". $row["Email"]. "<br>". "<b>Name: </b>". $row["Name"]. "<br>". "<b>Password: </b>". $row["Password"]. "<br><br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>

</body>
</html>

