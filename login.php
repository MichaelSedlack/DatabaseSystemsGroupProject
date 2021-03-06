<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && ($_SESSION["type"] === "super" || $_SESSION["type"] === "admin") ){
header("location: viewfaculty.php");
    exit;
}
header("location: viewform.php");
}


 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT FirstName FROM admin WHERE AdminUsername = '$username' AND Password = '$password'";
        $sql2 = "SELECT FirstName FROM faculty WHERE FacultyUsername = '$username' AND Password = '$password'";
        $sql4 = "SELECT FirstName FROM admin WHERE AdminUsername = '$username' AND reset = 1"; //needs to reset password

        if($stmt = mysqli_prepare($link, $sql)){
        
            if(mysqli_stmt_execute($stmt)){
                // Store result????
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){
                            // Username and Password are correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;    
                            $sql3 = "SELECT FirstName FROM admin WHERE super = 1 AND AdminUsername='$username'";
                            if($stmt = mysqli_prepare($link, $sql3)){
                                if(mysqli_stmt_execute($stmt)){
                                    mysqli_stmt_store_result($stmt);     
                                    if(mysqli_stmt_num_rows($stmt) == 1){ 
                                        $_SESSION["type"] = 'super'; //HERE IS THE VARIABLE FOR SUPER ADMIN
                                    }else{
                                        $_SESSION["type"] = 'admin';//HERE IS THE VARIABLE FOR ADMINS    //YOU CAN USE THESE ANYWHERE AFTER YOU LOG-IN
                                    }
                                }
                            }     
                            
                            if($stmt = mysqli_prepare($link, $sql4)){
                                if(mysqli_stmt_execute($stmt)){
                                    mysqli_stmt_store_result($stmt);     
                                    if(mysqli_stmt_num_rows($stmt) == 1){
                                        header("location: force-reset.php");
                                    }else{
                                        // Redirect user to welcome page
                                        header("location: viewfaculty.php");
                                    }
                                }
                            }     
                            
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        if($stmt = mysqli_prepare($link, $sql2)){
        
            if(mysqli_stmt_execute($stmt)){
                // Store result????
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){   
                            // Username and Password are correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;                      
                            $_SESSION["type"] = 'faculty';      //HERE IS THE VARIABLE FOR FACULTY

                            // Redirect user to welcome page
                            header("location: viewfaculty.php");
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
	    <a href="individual_custom.php">Forgot Password</a>
        </form>
    </div>
</body>
</html>