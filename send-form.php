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

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);
    $db = mysqli_select_db($conn, 'Bookstore');

    $name = $_POST['Username'];
    $id = $_POST['FormID'];
    $sem = $_POST['Semester'];
    $class = $_POST['Class'];
    $title = $_POST['Title'];
    $author = $_POST['Authors'];
    $ed = $_POST['Edition'];
    $pub = $_POST['Publisher'];
    $is = $_POST['ISBN'];

    $sql = "INSERT INTO Store (FacultyUsername, FormID, Semester, Class, Title, Authors, Edition, Publisher, ISBN)
    VALUES ('$name', '$id', '$sem', '$class', '$title', '$author', '$ed', '$pub', '$is' )";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    ?>
    
    <form action="CreateFinal.php">
      <br>
      <input type="submit" name='return' value="Return">
    </form>

  </center>
</body>
</html>
