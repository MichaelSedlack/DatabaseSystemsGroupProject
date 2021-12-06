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
  <?php
  
  // Create connection
  include 'db.php';
  $conn = connect();
  
  if(isset($_POST['search'])){

    $name = $_POST['Username'];
    $sem = $_POST['Semester'];

    $sql = "SELECT forms_list.FacultyUsername, forms_list.FormID,
            forms_list.Semester, individual_forms.FormID,
            individual_forms.Class, individual_forms.Title,
            individual_forms.Authors, individual_forms.Edition,
            individual_forms.Publisher, individual_forms.ISBN
            FROM forms_list, individual_forms
            WHERE forms_list.FacultyUsername = '$name' AND forms_list.Semester = '$sem'
            AND forms_list.FormID = individual_forms.FormID ";

    $query_run = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_array($query_run)){
      ?>
      <form action="send-form.php" method='post'>
        <input type='text' name = 'FormID' value='<?php echo $row['FormID'] ?>'/><br>
		<input type='text' name = 'Username' value='<?php echo $row['FacultyUsername'] ?>'/><br>
		<input type='text' name = 'Semester' value='<?php echo $row['Semester'] ?>'/><br>
        <input type='text' name = 'Class' value='<?php echo $row['Class'] ?>'/><br>
        <input type='text' name = 'Title' value='<?php echo $row['Title'] ?>'/><br>
        <input type='text' name = 'Authors' value='<?php echo $row['Authors'] ?>'/><br>
        <input type='text' name = 'Edition' value='<?php echo $row['Edition'] ?>'/><br>
        <input type='text' name = 'Publisher' value='<?php echo $row['Publisher'] ?>'/><br>
        <input type='text' name = 'ISBN' value='<?php echo $row['ISBN'] ?>'/><br>
      <?php
    }

  }
  ?>
        <input type="submit" name='search' value="Submit Form"><br>
      </form>
    
    <form action="CreateFinal.php">
      <br>
      <input type="submit" name='return' value="Return">
    </form>

</center>
</body>
</html>