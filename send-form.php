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

    $i = $_POST["i"];
    for($j = 1; $j < $i; $j++)
    {
      $name = $_POST[$j.'Username'];
      $id = $_POST[$j.'FormID'];
      $sem = $_POST[$j.'Semester'];
      $class = $_POST[$j.'Class'];
      $title = $_POST[$j.'Title'];
      $author = $_POST[$j.'Authors'];
      $ed = $_POST[$j.'Edition'];
      $pub = $_POST[$j.'Publisher'];
      $is = $_POST[$j.'ISBN'];

      $sql = "INSERT INTO Store (FacultyUsername, FormID, Semester, Class, Title, Authors, Edition, Publisher, ISBN)
      VALUES ('$name', '$id', '$sem', '$class', '$title', '$author', '$ed', '$pub', '$is' )";

      if ($conn->query($sql) === TRUE) {
        if($j == $i - 1)
          echo "Form Sent Successfully !!!";
      }
      else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }
    ?>
    <form action="CreateFinal.php">
      <br>
      <input type="submit" name='return' value="Return">
    </form>

  </center>
</body>
</html>
