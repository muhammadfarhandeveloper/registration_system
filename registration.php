<?php

// checking the session if is set go to profile page 

session_start();

if (isset($_SESSION['username'])) {

    header("Location: http://localhost/Registration%20System/profile.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
</head>

<body>

    <?php include 'nav.php' ?>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

        <input type="text" name="username" required placeholder="Enter Username"><br>
        <input type="password" min="8" name="password" required placeholder="Enter Password"><br>
        <input type="email" name="email" required placeholder="Enter email"><br>
        <input type="file" name="myimg" accept="image/png , image/jpg" />
        <br>
        <br><br>
        <button type="submit" name="signup">Sign up</button>
    </form>



    <?php

    if (isset($_POST['signup'])) {

        include 'config.php';

        $user = mysqli_real_escape_string($con, $_POST['username']);

        $sql2 = "select * from registration where username='$user'";
        $result2 = mysqli_query($con, $sql2);

        if (mysqli_num_rows($result2) > 0) {
            echo "Username already Registered";
        } else {

            if (isset($_FILES['myimg'])) {

                $imgname = $_FILES['myimg']['name'];
                $tmpname = $_FILES['myimg']['tmp_name'];

                move_uploaded_file($tmpname, "images/" . $imgname);

                $user = mysqli_real_escape_string($con, $_POST['username']);
                $pass = mysqli_real_escape_string($con, md5($_POST['password']));
                $email = mysqli_real_escape_string($con, $_POST['email']);

                $sql = "insert into registration(username,password,email,img) values('$user','$pass','$email','$imgname')";
                $result = mysqli_query($con, $sql) or die("Query Expired");

                if ($result) {

                    $_SESSION['username'] = $user;
                    $_SESSION['pass'] = $pass;


                    header("Location: http://localhost/Registration%20System/profile.php");
                }
            }
        }
    }


    ?>


</body>

</html>