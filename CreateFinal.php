<!DOCTYPE html>
<html lang = 'en'>
<head>
  <meta charset="utf-8">
  <title>Final List></title>
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
</head>
<body>
  <center>
  <h1>Create Final List</h1>
  <form action="search.php" method="POST">
    Please enter your Username<br>
    <input type="text" name="Username" placeholder="Username" >
    <br>
    <input type="text" name="Semester" placeholder="Semester" >
    <br>
    <input type="submit" name='search' value="Search Form">
  </form>

</center>
</body>
</html>
