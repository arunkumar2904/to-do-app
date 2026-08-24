<?php
include('config\db_con.php');
if(isset($_POST['signup'])){
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "insert into user (name, email, password) VALUES ('$fullname', '$email', '$password')";
    $res = mysqli_query($conn,$query);
    if(!$res)
        {
            die("Data Not Inserted".mysqli_error());
        }
    else{
        header('location:index.php?ins_msg=Data Added Sucessfully');
    }
}

?>