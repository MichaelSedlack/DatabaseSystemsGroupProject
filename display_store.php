<?php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Store";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<b>FacultyUsername:</b> ". $row["FacultyUsername"].
    "<br>". " <b>FormID:</b> ". $row["FormID"].
    "<br>". "<b>Semester: </b>". $row["Semester"].
    "<br>". "<b>Class: </b>". $row["Class"].
    "<br>". "<b>Title: </b>". $row["Title"].
    "<br>". "<b>Authors: </b>". $row["Authors"].
    "<br>". "<b>Edition: </b>". $row["Edition"].
    "<br>". "<b>Publisher: </b>". $row["Publisher"].
    "<br>". "<b>ISBN: </b>". $row["ISBN"]. "<br><br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?>
