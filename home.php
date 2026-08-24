<?php 
session_start();
include('config\db_con.php');
if(!isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>To-Do App - Dashboard</title>

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

    .logo {
    display: flex;
    justify-content: center;
    align-items: center;
    }

    .logo img {
        width: 150px;
        height: auto;
        display: block;
    }
    /* .logo{
        font-size:28px;
        font-weight:700;
        margin-bottom:40px;
        text-align:center;
    } */

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


    /* =========================
    MODAL
    ========================= */

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        inset: 0;
        background: rgba(0,0,0,.5);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background: #fff;
        width: 450px;
        max-width: 90%;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,.2);
        animation: modalOpen .2s ease;
    }

    @keyframes modalOpen {

        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .modal-header h2 {
        margin: 0;
        color: #333;
    }

    .close-btn {
        border: none;
        background: transparent;
        font-size: 28px;
        color: #777;
        cursor: pointer;
    }

    .close-btn:hover {
        color: #333;
    }

    /* =========================
    MODAL BUTTONS
    ========================= */

    .modal-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .cancel-btn,
    .save-btn {
        border: none;
        padding: 10px 18px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .cancel-btn {
        background: #f1f1f1;
        color: #555;
    }

    .cancel-btn:hover {
        background: #ddd;
    }

    .save-btn {
        background: #4f46e5;
        color: white;
    }

    .save-btn:hover {
        background: #3730a3;
    }


    /* Logout Button */

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


    .confirm-btn {
        background: #ef4444;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        font-weight: 600;
    }

    .confirm-btn:hover {
        background: #dc2626;
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

        <!-- Cards -->
        <?php 
        $query = "SELECT COUNT(*) AS total_tasks, SUM(status = 1) AS pending_tasks,
                    SUM(status = 2) AS completed_tasks FROM tasks WHERE user_id = '$user_id'
                    AND active = '1'";
        $result = mysqli_query($conn, $query);

        $data = mysqli_fetch_assoc($result);

        $total_tasks     = $data['total_tasks'];
        $pending_tasks   = $data['pending_tasks'];
        $completed_tasks = $data['completed_tasks'];
        ?>
        <section class="cards">
            <div class="card total">
                <h3>Total Tasks</h3>
                <h1><?php echo $total_tasks; ?></h1>
            </div>

            <div class="card pending">
                <h3>Pending Tasks</h3>
                <h1><?php echo $pending_tasks; ?></h1>
            </div>

            <div class="card completed">
                <h3>Completed Tasks</h3>
                <h1><?php echo $completed_tasks; ?></h1>
            </div>

        </section>

        <!-- Welcome -->

        <section class="content">

            <div class="welcome">

                <h2>Welcome Back <?php echo $_SESSION['name']; ?> 👋</h2>
                <p>
                    Manage your daily tasks efficiently.
                    Use the sidebar to create, edit, complete, or delete tasks.
                    Your task statistics are shown above.
                </p>

            </div>

        </section>

    </main>

</div>

<!-- ==================================================
     LOGOUT MODAL
=================================================== -->

<div class="modal" id="logoutModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Logout</h2>

            <button
                type="button"
                class="close-btn"
                onclick="closeLogoutModal()">

                &times;

            </button>

        </div>


        <p>
            Are you sure you want to logout?
        </p>


        <div class="modal-buttons">

            <button
                class="cancel-btn"
                onclick="closeLogoutModal()">

                Cancel

            </button>


            <a
                href="/To-Do/logout.php"
                class="confirm-btn">

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

/* ==================================================
   CLOSE MODALS WHEN CLICKING OUTSIDE
=================================================== */

window.addEventListener("click", function(event) {

    const taskModal =
        document.getElementById("taskModal");

    const logoutModal =
        document.getElementById("logoutModal");

    const deleteModal =
        document.getElementById("deleteModal");


    if (event.target === taskModal) {

        closeTaskModal();

    }


    if (event.target === logoutModal) {

        closeLogoutModal();

    }

    if (event.target === deleteModal) {

        closeDeleteModal();

    }

});
</script>
</html>