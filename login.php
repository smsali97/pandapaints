<?php
session_start(); 
// starting a session 
    // check session is set (if user has already login, redirect to the profile page)
    if(isset($_SESSION['id']))
    {
        if (!isset($_SESSION['spid'])) { header("location: /pandapaints/users/index.php"); }
        else { header("location: /pandapaints/customers/index.php"); }
        exit;
    }
 
    $error_message = "";
    // check for form submit action 
    if(isset($_POST['username']) && isset($_POST['password']))
    {
        // basic input validation
        if($_POST['username'] == "" || $_POST['password'] == "")
        {
            $error_message = "Please enter your login details!";
        }
        else
        {
            // validate user ( if successfully validated, redirect to the profile page)
            include("ajax/db_connection.php");
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $password = md5(mysqli_real_escape_string($con, $_POST['password']));
 
            $query = "SELECT * FROM users_13005 WHERE BINARY username = '$username' AND password = '$password'";
            if(!$result = mysqli_query($con, $query))
            {
                exit(mysqli_error($con));
            }
 
            if(mysqli_num_rows($result) > 0)
            {
                // Login successfully
                while($row = mysqli_fetch_assoc($result))
                {
                    // set sessions variable with the user details
                    $_SESSION['id'] =  $row['uid'];
                    $_SESSION['username'] =  $row['username'];
                    $_SESSION['user_type'] = $row['user_type'];
                    $_SESSION['spid'] = $row['fk_spid'];
                    // USER TYPE?!
                }
 
                // redirect to the secure page ex. user profile 
                
                // If admin
                if (!isset($_SESSION['spid'])) { header("location: /pandapaints/users/index.php"); }
                else { header("location: /pandapaints/customers/index.php"); }
                exit;
            }
            else
            {
                // show error message
                $error_message = "Invalid login details, Please try again!";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | PandaPaints</title>
 
    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>

    <nav class="navbar bg-success">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/pandapaints/index.php">Panda Paints</a>

            </div>
            <ul class="nav navbar-nav">
                <li><img src="/pandapaints/panda.png" class="img-responsive img-icons"></li>
                   <style>
                    .img-icons {
                         padding: 0.5em;
                    }

                    </style>
                 <li class="nav-item disabled"><a class="nav-link" href="/pandapaints/salesorder/">Sales Order</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/customers/">Customers</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/products/">Products</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/salespersons/">Salespersons</a></li>
                <li class="nav-item disabled"><a class="nav-link disabled" href="/pandapaints/users/">Users</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/pandapaints/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li class="active"><a href="/pandapaints/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </nav> 


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Login</h2>
                <p>
                    <a href="/pandapaints/index.php">Home</a> | <a href="/pandapaints/login.php">Login</a> | <a href="/pandapaints/register.php">Register</a>
                </p>
                <form method="post" action="login.php">
                    <div class="form-group">
                        <?php 
                            // show error message
                            echo $error_message 
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6"></div>

        </div>

        <a class="info" href="/pandapaints/forgotpassword.html">Forgot your password?</a>
        <br>
        <p class="text-warning">Some sample accounts to play with: 
<ul>
<li> Admin: sysadmin (username) sysadmin (password) </li>
<li> User: sualeh (username) sualeh (password) </li>
<li> User: john (username) john (password) </li>
</ul>
</p>
  <h5 class="text-danger">WITH GREAT POWER COMES GREAT RESPONSIBILITY. PLEASE DO NOT MESS WITH THE ACOUNTS. THE CREDENTIALS PROVIDED IS FOR DEMONSTRATION PURPOSES ONLY.</h5></p>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    

</body>
</html>