<?php

session_start();

    if(!isset($_SESSION['username'])){
        header("Location: http://localhost/Registration%20System/login.php");
        
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

    <?php

    $myid = $_GET['id']??"";

    include 'config.php';

    $sql = "select * from registration where id = '{$myid}'";
    $result = mysqli_query($con, $sql) or die("QUery Expired");

    if (mysqli_num_rows($result) == 1) {

        while ($row = mysqli_fetch_assoc($result)) {

    ?>

            <br><br><br>    
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                <input type="text" name="username" value="<?php echo $row['username'] ?>"><br>
                <input type="email" name="email" value="<?php echo $row['email'] ?>"><br>
                <img src="images/<?php echo $row['img'] ?>" width="80px" height="80px" alt="">
                <input type="hidden" name="imgsrc" value="<?php echo $row['img'] ?>">
                <br/> 
                <input type="file" name="myimg" />
                <br><br>
                <button type="submit" name="update">Update</button>
            </form>





    <?php

        }
    }


    ?>

    <?php

    if (isset($_POST['update'])) {

        include 'config.php';

        $user = $_POST['username'];
        $email = $_POST['email'];
        $id = $_POST['id'];
        $imgname = $_FILES['myimg']['name'];
        $imgtmpname = $_FILES['myimg']['tmp_name'];
        $imgsrc = $_POST['imgsrc']; 

        $sql = "select * from registration where username='$user'";
        $result2 = mysqli_query($con, $sql);
        if (mysqli_num_rows($result2) == 1) {
            echo "<script>alert('Already Username Exist')</script>";
        } else {

                if (is_uploaded_file($_FILES['myimg']['tmp_name'])) {

                    echo $imgsrc;
                    
                    $sql2 = "update registration set username = '$user', email = '$email' , img = '$imgname' where id = $id";
                    
                    $result3 = mysqli_query($con, $sql2);
                    if ($result3) {
                        
                        unlink("images/".$imgsrc);
                        move_uploaded_file($imgtmpname,"images/".$imgname);
                        

                        $_SESSION['username'] = $user;
                        echo "<script>alert('Data Updated with Image!') 
                         window.location.href = 'profile.php';
                          </script>";

                    }
            }
             else {
                $sql3 = "update registration set username = '$user', email = '$email' where id = $id";
                
                $result4 = mysqli_query($con, $sql3);
                if ($result4) {
                    $_SESSION['username'] = $user;
                    echo "<script>alert('Data Updated with out Image!') 
                    window.location.href = 'profile.php';
                     </script>";

                }
            }
        }
        }

    ?>


</body>

</html>