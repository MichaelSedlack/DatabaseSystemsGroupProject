<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Created!</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<h1 class="my-5">Admin Successfully Created!</h1>
<h1 class="my-5">Password: <b><?php echo htmlspecialchars($_SESSION["word"]);?></b></h1>
    <p>
        <a href="viewfaculty.php" class="btn btn-warning">OK</a>
    </p>
</body>
</html>