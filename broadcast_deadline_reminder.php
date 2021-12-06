<?php

include 'db.php';

// Create connection
$conn = connect();


 $sql = "SELECT Email FROM faculty";
 $result = $conn->query($sql);

 if($result->num_rows > 0) 
 {
      while($row = $result->fetch_assoc())
      {
      $email_to = $row["Email"];
      $headers = "From:" . "noreply@website.in";
      $subject = "Book Ordering Deadline Reminder";
      $message = 'This is an broadcast reminder to please put in your book order by 01/08/2022.

Sincerely,

Bookstore Staff
';
      mail($email_to,$subject,$message,$headers);
      }
 } else {
 
 $conn->close();

 }

?>