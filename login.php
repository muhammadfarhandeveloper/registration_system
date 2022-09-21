<?php

session_start();

    if(isset($_SESSION['username'])){
        header("Location: http://localhost/Registration%20System/profile.php");
        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php include 'nav.php' ?>


 <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

 <input type="text" name="username"  placeholder="Enter Username"/><br>
 <input type="password" name="password"  placeholder="Enter Password"/><br>
 <button type="submit" name="login">Login</button>

    

 </form>

 <?php


    if(isset($_POST['login'])){

        include 'config.php';

        $user = mysqli_real_escape_string($con, $_POST['username']);
        $pass = mysqli_real_escape_string($con, md5($_POST['password']));

        $sql = "select * from registration where username='{$user}' and password='{$pass}'";
        $result = mysqli_query($con,$sql) or die("Query Expired");

        if(mysqli_num_rows($result) > 0){

            $_SESSION['username'] = $user; 
            $_SESSION['pass'] = $pass; 

            header("Location: http://localhost/Registration%20System/profile.php");

        }
        else{
            echo "login Failed";
        }



    }


?>

    
</body>
</html>