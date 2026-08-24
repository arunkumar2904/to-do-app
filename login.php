<?php
include('config\db_con.php');
if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "select * from user where email = '$email' and password = '$password' and status = '1'";
        $res = mysqli_query($conn,$query);
        if(!$res)
            {
                die("Query Error: ".mysqli_error($conn));
            }
        if(mysqli_num_rows($res)==1)
            {
                session_start();

                $row = mysqli_fetch_assoc($res);

                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                
                header("Location: home.php");
                exit();
            }
        else
            {
            header('location:index.php?inv_log=Invalid Login');
            }
        
    }
?>
