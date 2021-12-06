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
    include 'db.php';

    $delete = $_POST['name'];

    // Create connection
    $conn = connect();

    $sql = "DELETE FROM admin WHERE AdminUsername = '$delete'";

    if ($conn->query($sql) === TRUE) {
      echo "Delete admin successfully";
    }
    else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    ?>

    <h1>Admin Users</h1>
    <table>
      <tr>
        <td>AdminUsername</td>
        <td>Email</td>
        <td>FirstName</td>
        <td>LastName</td>
      </tr>

      <?php
      $sql = "SELECT * FROM admin";
      $result = $conn->query($sql);
      if($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc())
        {
          echo "<tr><td>" . $row['AdminUsername'] . "</td><td>" .
                $row['Email'] . "</td><td>" . $row['FirstName'] . "</td><td>" .
                $row['LastName'] . "</td></tr>";
        }
      }
      else
      {
        echo 'No Admin';
      }

      $conn->close();
       ?>

  </center>
</body>
</html>
