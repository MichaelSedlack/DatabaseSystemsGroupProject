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
    <h1>Delete Admin</h1>
    <form action = 'delete.php' method="POST">
      <input type="text" name="admin" placeholder="admin" >
      <br>
      <input type="submit" name='delete' value="Delete User">
    </form>

    <h1>Admin User</h1>
    <table>
      <tr>
        <td>AdminUsername</td>
        <td>Email</td>
        <td>FirstName</td>
        <td>LastName</td>
      </tr>

      <?php
      $servername = "localhost";
      $username = "root";
      $password = "root";
      $conn = mysqli_connect($servername, $username, $password);
      $db = mysqli_select_db($conn, 'Bookstore');

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
    </table>


  </center>
</body>
</html>
