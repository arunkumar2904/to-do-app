<?php

session_start();
include('config\db_con.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];


/* =========================
   GET USER
========================= */

$query = "SELECT * FROM user WHERE id = '$user_id'";

$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    header('Location: home.php');
    exit;
}

/* =========================
   UPDATE PROFILE
========================= */

if (isset($_POST['update_profile'])) 
    {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $query = "UPDATE user
                SET name = '$name',
                    email = '$email'
                WHERE id = '$user_id'";

        if (mysqli_query($conn, $query)) {

            header("Location: profile.php?success=1");
            exit;

        } else {

            $error = "Something went wrong.";

        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>To-Do App - Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect"
          href="https://fonts.gstatic.com"
          crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">


<style>

/* =========================
   GENERAL
========================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background: #f4f7fc;
}

.container {
    display: flex;
    min-height: 100vh;
}

.main {
    flex: 1;
}


/* =========================
   PROFILE PAGE
========================= */

.profile-container {
    padding: 35px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.profile-title {
    width: 100%;
    max-width: 900px;
    margin-bottom: 25px;
}

.profile-title h2 {
    color: #1e293b;
    font-size: 26px;
}

.profile-title p {
    color: #64748b;
    margin-top: 5px;
}


/* =========================
   PROFILE CARD
========================= */

.profile-card {
    width: 100%;
    max-width: 900px;
    background: white;
    border-radius: 15px;
    padding: 35px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}


/* =========================
   PROFILE TOP
========================= */

.profile-top {
    display: flex;
    align-items: center;
    gap: 25px;
    padding-bottom: 30px;
    border-bottom: 1px solid #eee;
}

.profile-avatar {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #3b82f6;
    color: white;

    display: flex;
    justify-content: center;
    align-items: center;

    font-size: 35px;
    font-weight: 600;
}

.profile-info h2 {
    color: #1e293b;
    margin-bottom: 5px;
}

.profile-info p {
    color: #64748b;
}


/* =========================
   DETAILS
========================= */

.profile-details {
    margin-top: 30px;
}

.profile-details h3 {
    color: #1e293b;
    margin-bottom: 20px;
}

.profile-row {
    display: flex;
    justify-content: space-between;
    align-items: center;

    padding: 16px 0;

    border-bottom: 1px solid #eee;
}

.profile-row:last-child {
    border-bottom: none;
}

.profile-label {
    color: #64748b;
    font-size: 14px;
}

.profile-value {
    color: #1e293b;
    font-weight: 500;
}


/* =========================
   EDIT SECTION
========================= */

.edit-section {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.edit-section h3 {
    color: #1e293b;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    display: block;
    margin-bottom: 7px;

    font-size: 14px;
    font-weight: 600;

    color: #475569;
}

.form-group input {
    width: 100%;
    padding: 11px 13px;

    border: 1px solid #d1d5db;
    border-radius: 8px;

    font-size: 14px;
    outline: none;
}

.form-group input:focus {
    border-color: #3b82f6;
}

/* =========================
   SIDEBAR
========================= */

.sidebar {
    width: 250px;
    background: #1E293B;
    color: white;
    padding: 25px;
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

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin: 18px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    display: block;
    padding: 12px 15px;
    border-radius: 10px;
    transition: .3s;
}

.sidebar ul li a:hover {
    background: #3B82F6;
}

/* =========================
   NAVBAR
========================= */

.navbar {
    background: white;
    padding: 18px 35px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,.08);
}

.navbar h2 {
    color: #333;
}

.account {
    display: flex;
    align-items: center;
    gap: 15px;
}

.avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: #3B82F6;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    font-size: 18px;
}

.account-info h4 {
    font-size: 15px;
}

.account-info p {
    color: gray;
    font-size: 13px;
}

/* =========================
   SAVE BUTTON
========================= */

.save-btn {
    border: none;

    background: #3b82f6;
    color: white;

    padding: 11px 22px;

    border-radius: 8px;

    font-size: 14px;
    font-weight: 600;

    cursor: pointer;
}

.save-btn:hover {
    background: #2563eb;
}


/* =========================
   MESSAGE
========================= */

.success {
    background: #dcfce7;
    color: #15803d;

    padding: 12px 15px;

    border-radius: 8px;

    margin-bottom: 20px;
}

.error {
    background: #fee2e2;
    color: #dc2626;

    padding: 12px 15px;

    border-radius: 8px;

    margin-bottom: 20px;
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

/* =========================
   RESPONSIVE
========================= */

@media (max-width: 700px) {

    .profile-container {
        padding: 20px;
    }

    .profile-card {
        padding: 25px;
    }

    .profile-top {
        flex-direction: column;
        align-items: flex-start;
    }

    .profile-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }

}

</style>

</head>


<body>

<div class="container">


    <!-- SIDEBAR -->

    <?php include('includes\sidebar.php'); ?>


    <main class="main">


        <!-- NAVBAR -->

        <?php include('includes\navbar.php'); ?>


        <!-- PROFILE CONTENT -->

        <div class="profile-container">


            <div class="profile-title">

                <h2>My Profile</h2>

                <p>
                    Manage your account information
                </p>

            </div>


            <?php if (isset($_GET['success'])) { ?>

                <div class="success">
                    Profile updated successfully!
                </div>

            <?php } ?>


            <?php if (isset($error)) { ?>

                <div class="error">
                    <?= htmlspecialchars($error); ?>
                </div>

            <?php } ?>


            <div class="profile-card">


                <!-- PROFILE HEADER -->

                <div class="profile-top">

                    <div class="profile-avatar">

                        <?= strtoupper(
                            substr($user['name'], 0, 1)
                        ); ?>

                    </div>


                    <div class="profile-info">

                        <h2>
                            <?= htmlspecialchars($user['name']); ?>
                        </h2>

                        <p>
                            <?= htmlspecialchars($user['email']); ?>
                        </p>

                    </div>

                </div>


                <!-- ACCOUNT DETAILS -->

                <div class="profile-details">

                    <h3>Account Information</h3>

                    <div class="profile-row">

                        <span class="profile-label">
                            Full Name
                        </span>

                        <span class="profile-value">
                            <?= htmlspecialchars($user['name']); ?>
                        </span>

                    </div>


                    <div class="profile-row">

                        <span class="profile-label">
                            Email Address
                        </span>

                        <span class="profile-value">
                            <?= htmlspecialchars($user['email']); ?>
                        </span>

                    </div>

                </div>


                <!-- EDIT PROFILE -->

                <div class="edit-section">

                    <h3>Edit Profile</h3>


                    <form method="POST">


                        <div class="form-group">

                            <label>
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="<?= htmlspecialchars($user['name']); ?>"
                                required>

                        </div>


                        <div class="form-group">

                            <label>
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="<?= htmlspecialchars($user['email']); ?>"
                                required>

                        </div>


                        <button
                            type="submit"
                            name="update_profile"
                            class="save-btn">

                            Save Changes

                        </button>


                    </form>

                </div>


            </div>

        </div>


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
```
