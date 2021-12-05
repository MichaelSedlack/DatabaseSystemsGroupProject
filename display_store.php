<!DOCTYPE html>
<html>
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
<body>
  <center>
    <?php

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "Bookstore";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Store";

    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){
      echo"<table border = '1'>";
      echo"<tr><td>{$row['FacultyUsername']}</td></tr";

      while($row = mysqli_fetch_assoc($result)){
        echo" <tr><td>{$row['FormID']}</td>
              <td>{$row['Semester']}</td>
              <td>{$row['Class']}</td>
              <td>{$row['Title']}</td>
              <td>{$row['Authors']}</td>
              <td>{$row['Edition']}</td>
              <td>{$row['Publisher']}</td>
              <td>{$row['ISBN']}</td></tr>";
      }
    }
 ?>
  </center>
</body>
</html>

