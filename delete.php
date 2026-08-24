<?php

session_start();
include('config\db_con.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $query = "UPDATE tasks SET active = '2' WHERE id = '$id' AND user_id = '$user_id'";

    if (mysqli_query($conn, $query)) {

        header("Location: tasks_list.php");
        exit;

    } else {

        echo "Error deleting task: " . mysqli_error($conn);

    }

} else {

    header("Location: tasks_list.php");
    exit;

}
?>