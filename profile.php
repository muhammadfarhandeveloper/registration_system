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
    <title>Profile</title>
</head>
<body>  

<?php include 'nav.php' ?>


<br>
    <?php   
    
        $user = $_SESSION['username'];

        include 'config.php';

        $sql = "select * from registration where username = '{$user}'";
        $result = mysqli_query($con,$sql) or die("QUery Expired");

        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){
        
                ?>  

                <table border="1">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Image</th>
                        <th>Update Profile</th>
                    </tr>

                    <tr>
                        <td><?php echo $row['id']?></td>
                        <td><?php echo $row['username']?></td>
                        <td><?php echo $row['email']?></td>
                        <td><?php echo "<img src='images/$row[img]' height='50' width='50px' />"?></td>
                        <td><a href="update.php?id=<?php echo $row['id']?>">Update Profile</a></td>
                    </tr>

                </table>



<?php

            }
        }

        echo "<h1>Welcome : $user </h1>" ;

        echo "<a> Update Profile </a>";
        

        
    ?>

    
</body>
</html>