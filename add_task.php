<?php
session_start();
include('config\db_con.php');
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
if(isset($_POST['submit']))
    {
        $user_id = $_SESSION['user_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $date = $_POST['date'];
        $query = "INSERT INTO tasks (user_id,title,description,status,date) VALUES ('$user_id','$title','$description','$status','$date')";
        $res = mysqli_query($conn,$query);
       
        if(!$res)
            {
                die("Query Error: ".mysqli_error($conn));
            }
        else
            {
                header('location:tasks_list.php');
            }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>To-Do App - Tasks List</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Poppins',sans-serif;
    }

    body{
        background:#f4f7fc;
    }

    /* Layout */

    .container{
        display:flex;
        min-height:100vh;
    }

    /* Sidebar */

    .sidebar{
        width:250px;
        background:#1E293B;
        color:white;
        padding:25px;
    }

    .logo{
        font-size:28px;
        font-weight:700;
        margin-bottom:40px;
        text-align:center;
    }

    .sidebar ul{
        list-style:none;
    }

    .sidebar ul li{
        margin:18px 0;
    }

    .sidebar ul li a{
        text-decoration:none;
        color:white;
        display:block;
        padding:12px 15px;
        border-radius:10px;
        transition:.3s;
    }

    .sidebar ul li a:hover{
        background:#3B82F6;
    }

    /* Main */

    .main{
        flex:1;
    }

    /* Navbar */

    .navbar{
        background:white;
        padding:18px 35px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        box-shadow:0 2px 10px rgba(0,0,0,.08);
    }

    .navbar h2{
        color:#333;
    }

    .account{
        display:flex;
        align-items:center;
        gap:15px;
    }

    .avatar{
        width:45px;
        height:45px;
        border-radius:50%;
        background:#3B82F6;
        color:white;
        display:flex;
        justify-content:center;
        align-items:center;
        font-weight:bold;
        font-size:18px;
    }

    .account-info h4{
        font-size:15px;
    }

    .account-info p{
        color:gray;
        font-size:13px;
    }

    /* Cards */

    .cards{
        display:grid;
        grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
        gap:25px;
        padding:35px;
    }

    .card{
        background:white;
        border-radius:15px;
        padding:25px;
        box-shadow:0 10px 25px rgba(0,0,0,.08);
        transition:.3s;
    }

    .card:hover{
        transform:translateY(-5px);
    }

    .card h3{
        color:#666;
        font-weight:500;
        margin-bottom:15px;
    }

    .card h1{
        font-size:45px;
    }

    .total{
        border-left:6px solid #3B82F6;
    }

    .pending{
        border-left:6px solid orange;
    }

    .completed{
        border-left:6px solid limegreen;
    }

    /* Welcome */

    .content{
        padding:0 35px 35px;
    }

    .welcome{
        background:white;
        padding:30px;
        border-radius:15px;
        box-shadow:0 10px 25px rgba(0,0,0,.08);
    }

    .welcome h2{
        margin-bottom:10px;
    }

    .welcome p{
        color:#666;
        line-height:1.6;
    }

    /* Logout Button */

    .logout-btn{
        background:#ef4444;
        color:#fff;
        border:none;
        padding:10px 20px;
        border-radius:8px;
        cursor:pointer;
        font-size:15px;
        transition:.3s;
    }

    .logout-btn:hover{
        background:#dc2626;
    }

    /* Modal */

    .modal{
        display:none;
        position:fixed;
        inset:0;
        background:rgba(0,0,0,.55);
        justify-content:center;
        align-items:center;
        z-index:999;
    }

    .modal-content{
        width:350px;
        background:#fff;
        padding:30px;
        border-radius:15px;
        text-align:center;
        animation:popup .3s ease;
    }

    @keyframes popup{
        from{
            transform:scale(.8);
            opacity:0;
        }
        to{
            transform:scale(1);
            opacity:1;
        }
    }

    .modal-content h2{
        margin-bottom:15px;
    }

    .modal-content p{
        color:#666;
        margin-bottom:25px;
    }

    .modal-buttons{
        display:flex;
        justify-content:center;
        gap:15px;
    }

    .cancel-btn,
    .confirm-btn{
        padding:10px 20px;
        border:none;
        border-radius:8px;
        cursor:pointer;
        text-decoration:none;
        font-weight:600;
    }

    .cancel-btn{
        background:#d1d5db;
    }

    .cancel-btn:hover{
        background:#9ca3af;
    }

    .confirm-btn{
        background:#ef4444;
        color:#fff;
    }

    .confirm-btn:hover{
        background:#dc2626;
    }

    .logout-link{
        width:100%;
        background:none;
        border:none;
        color:#fff;
        text-align:left;
        padding:12px 15px;
        font-size:16px;
        cursor:pointer;
        border-radius:10px;
        transition:.3s;
    }

    .logout-link:hover{
        background:#3B82F6;
    }

    .table-container{

    margin:35px;
    background:#fff;
    padding:25px;
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);

    }

    .table-header{

        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;

    }

    .table-header h2{

        color:#333;

    }

    .add-btn{

        background:#2563eb;
        color:#fff;
        border:none;
        padding:10px 18px;
        border-radius:8px;
        cursor:pointer;
        font-weight:600;

    }

    .add-btn:hover{

        background:#1d4ed8;

    }

    table{

        width:100%;
        border-collapse:collapse;

    }

    thead{

        background:#2563eb;
        color:white;

    }

    th,td{

        padding:15px;
        text-align:left;

    }

    tbody tr{

        border-bottom:1px solid #eee;
        transition:.3s;

    }

    tbody tr:hover{

        background:#f8fafc;

    }

    .pending{

        background:#fef3c7;
        color:#b45309;
        padding:6px 12px;
        border-radius:20px;
        font-size:13px;
        font-weight:600;

    }

    .completed{

        background:#dcfce7;
        color:#15803d;
        padding:6px 12px;
        border-radius:20px;
        font-size:13px;
        font-weight:600;

    }

    .edit-btn{

        background:#3b82f6;
        color:white;
        border:none;
        padding:8px 15px;
        border-radius:6px;
        cursor:pointer;

    }

    .edit-btn:hover{

        background:#2563eb;

    }

    .delete-btn{

        background:#ef4444;
        color:white;
        border:none;
        padding:8px 15px;
        border-radius:6px;
        cursor:pointer;
        margin-left:8px;

    }

    .delete-btn:hover{

        background:#dc2626;

    }

</style>

</head>
<body>

<div class="container">

    <!-- Sidebar -->

    <?php include('includes\sidebar.php'); ?>

    <!-- Main -->

    <main class="main">

        <?php include('includes\navbar.php'); ?>

        <!-- Table -->

        <div class="table-container">

            <div class="table-header">
                <h2>My Tasks</h2>
                <button class="add-btn">+ Add Task</button>
            </div>

            <table>

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Complete PHP Project</td>
                        <td>Finish CRUD operations</td>
                        <td><span class="pending">Pending</span></td>
                        <td>07 Aug 2026</td>

                        <td>

                            <button class="edit-btn">Edit</button>

                            <button class="delete-btn">Delete</button>

                        </td>

                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Buy Groceries</td>
                        <td>Milk, Bread, Eggs</td>
                        <td><span class="completed">Completed</span></td>
                        <td>06 Aug 2026</td>

                        <td>

                            <button class="edit-btn">Edit</button>

                            <button class="delete-btn">Delete</button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

        <!-- Welcome -->

        <section class="content">

            <div class="welcome">

                <h2>Welcome Back 👋</h2>

                <p>
                    Manage your daily tasks efficiently.
                    Use the sidebar to create, edit, complete, or delete tasks.
                    Your task statistics are shown above.
                </p>

            </div>

        </section>

    </main>

</div>
<!-- Modal -->

<div class="modal" id="logoutModal">

    <div class="modal-content">

        <h2>Logout</h2>

        <p>Are you sure you want to logout?</p>

        <div class="modal-buttons">

            <button class="cancel-btn" onclick="closeLogoutModal()">
                Cancel
            </button>

            <a href="logout.php" class="confirm-btn">
                Logout
            </a>

        </div>

    </div>

</div>
</body>
<script>
    function openLogoutModal(){
    document.getElementById("logoutModal").style.display = "flex";
}

function closeLogoutModal(){
    document.getElementById("logoutModal").style.display = "none";
}
</script>
</html>