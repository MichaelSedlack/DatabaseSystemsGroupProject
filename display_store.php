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
    <table border="2">
      <tr>
        <td>FacultyUsername</td>
        <td>Semester</td>
        <td>FormID</td>
        <td>Class</td>
        <td>Title</td>
        <td>Authors</td>
        <td>Edition</td>
        <td>Publisher</td>
        <td>ISBN</td>
      </tr>
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

    $sql = "SELECT * FROM Store ORDER BY Semester, FacultyUsername";

    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0){

      while($row = mysqli_fetch_assoc($result)){
        ?>
          <tr>
            <td><?php echo $row['FacultyUsername']; ?></td>
            <td><?php echo $row['Semester']; ?></td>
            <td><?php echo $row['FormID']; ?></td>
            <td><?php echo $row['Class']; ?></td>
            <td><?php echo $row['Title']; ?></td>
            <td><?php echo $row['Authors']; ?></td>
            <td><?php echo $row['Edition']; ?></td>
            <td><?php echo $row['Publisher']; ?></td>
            <td><?php echo $row['ISBN']; ?></td>
          </tr>

          <?php
        }
      }
      else{
        echo 'No Result';
      }
          ?>
      </table>
  </center>
</body>
</html>
