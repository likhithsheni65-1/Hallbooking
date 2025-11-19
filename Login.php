<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Includes/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Includes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Includes/css/style.css">
    <title>Login</title>
</head>

<?php

session_start();
require 'includes/db_connect.php';

//	$mail=$_POST['user_email'];
//	$password=$_POST['user_pwd'];
//	$msg="";
//	$result=mysqli_query( $connect_mysql, "SELECT * FROM clients WHERE email='$mail' AND password='$password' ");

if (isset($_POST["admin_email"])) {
    $mail = $_POST['admin_email'];
    $password = $_POST['admin_password'];

    $sql = "SELECT * FROM admin WHERE email='" . $mail . "' AND password='" . md5($password) . "' LIMIT 1";

    $result = mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) == 1) {
        //echo "WELLCOME BACK ";
        //session_start();

        //while(
        $row = mysqli_fetch_assoc($result);//) 
        //{
        //echo $row["name"]."<br>";
        //session_start();
        $_SESSION["admin_name"] = $row["name"];
        $_SESSION["admin_id"] = $row["id"];
        //echo "The session name is :";
        //echo $_SESSION["username"]."<br>";
        //echo '<a href="./Index.php">Home</a>';
        header("Location: ./index.php");
        //}
        exit();
    } else {
        echo " 
                            <div class=' alert alert-danger fw-bolder text-danger'>Invalid Credentials</div>
                            ";
        exit();
    }

}

?>

<body id="Top">
    <!-- <nav class="navbar navbar-expand-sm navbar-light bg-light">
        <a class="navbar-brand" href="#">ohbs</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="./index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
            </ul>
            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="list-style: none;">Admin</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav> -->

    <!-- Login Form -->
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-4 offset-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1>Admin Login</h1>
                        <p>Please Login using your admin Credentials!</p>

                    </div>


                    <div class="card-body shadow-lg">
                        <form action="" method="post">
                            <label for="admin_email">Email: </label>
                            <input class="form-control" type="email" name="admin_email" id="user_email" required>
                            <label for="admin_password">Password</label>
                            <input class="form-control" type="password" name="admin_password" id="user_pwd" required>
                            <button type="submit" class="btn btn-outline-success form-control mt-2">Log-in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./Includes/jquery/jquery.min.js"></script>
    <script src="./Includes/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>