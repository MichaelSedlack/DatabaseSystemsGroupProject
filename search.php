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
    <h1>Create Final List</h1>
    <form action="send-form.php" method='post'>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "root";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password);
  $db = mysqli_select_db($conn, 'Bookstore');
  if(isset($_POST['search'])){

    $name = $_POST['Username'];
    $sem = $_POST['Semester'];

    $sql = "SELECT *
            FROM forms_list, individual_forms
            WHERE forms_list.FacultyUsername = '$name' AND forms_list.Semester = '$sem'
            AND forms_list.FormID = individual_forms.FormID ";

    $query_run = mysqli_query($conn, $sql);

    $i = 0;
    for($i = 1;$row = mysqli_fetch_array($query_run); $i++){
      ?>
        <input type='text' name = <?php echo $i. 'Username'?> value='<?php echo $row['FacultyUsername'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'Semester'?> value='<?php echo $row['Semester'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'FormID'?> value='<?php echo $row['FormID'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'Class'?> value='<?php echo $row['Class'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'Title'?> value='<?php echo $row['Title'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'Authors'?> value='<?php echo $row['Authors'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'Edition'?> value='<?php echo $row['Edition'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'Publisher'?> value='<?php echo $row['Publisher'] ?>'/><br>
        <input type='text' name = <?php echo $i. 'ISBN'?> value='<?php echo $row['ISBN'] ?>'/><br>
      <?php
    }

  }
  ?>
  <input type = 'hidden' name = 'i' value = <?php echo $i ?>>
  <input type="submit" name='search' value="Submit Form"><br>
</form>

  <form action="CreateFinal.php">
    <br>
    <input type="submit" name='return' value="Return">
  </form>

</center>
</body>
</html>
