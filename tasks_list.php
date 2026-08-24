<?php
session_start();
include('config\db_con.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];


/* =========================
   UPDATE TASK
========================= */

if (isset($_POST['update_task'])) {

    $id          = $_POST['id'];
    $title       = $_POST['title'];
    $description = $_POST['description'];
    $status      = $_POST['status'];
    $date        = $_POST['date'];

    $query = "UPDATE tasks
              SET title = '$title',
                  description = '$description',
                  status = '$status',
                  date = '$date'
              WHERE id = '$id'
              AND user_id = '$user_id'";

    mysqli_query($conn, $query);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
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

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet"
>

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
   MAIN
========================= */

.main {
    flex: 1;
    min-width: 0;
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
   TABLE CONTAINER
========================= */

.table-container {
    margin: 35px;
    background: #fff;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.table-header h2 {
    color: #333;
}


/* =========================
   ADD BUTTON
========================= */

.add-btn {
    border: none;
    background: #3b82f6;
    color: #fff;
    padding: 10px 18px;
    border-radius: 7px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}

.add-btn:hover {
    background: #2563eb;
}


/* =========================
   TABLE
========================= */

.table-wrapper {
    width: 100%;
    overflow-x: auto;
}

table {
    width: 100%;
    min-width: 950px;
    border-collapse: collapse;
}

thead {
    background: #2563eb;
    color: white;
}

th,
td {
    padding: 15px;
    text-align: left;
    vertical-align: middle;
}

tbody tr {
    border-bottom: 1px solid #eee;
}

tbody tr:hover {
    background: #f8fafc;
}


/* =========================
   STATUS
========================= */

.pending {
    background: #fef3c7;
    color: #b45309;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.completed {
    background: #dcfce7;
    color: #15803d;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}


/* =========================
   BUTTONS
========================= */

.edit-btn {
    background: #3b82f6;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
    vertical-align: middle;
}

.edit-btn:hover {
    background: #2563eb;
}

.delete-btn {
    display: inline-block;
    background: #ef4444;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
    margin-left: 8px;
    text-decoration: none;
    vertical-align: middle;
}

.delete-btn:hover {
    background: #dc2626;
}

.update-btn {
    background: #16a34a;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
    vertical-align: middle;
}

.update-btn:hover {
    background: #15803d;
}


/* =========================
   EDIT INPUT
========================= */

.edit-input {
    width: 100%;
    min-width: 120px;
    height: 38px;
    padding: 8px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    outline: none;
    background: #fff;
    vertical-align: middle;
}

.edit-input:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 2px rgba(79,70,229,.1);
}


/* =========================
   TEXTAREA EDIT INPUT
========================= */

textarea.edit-input {
    height: 38px;
    min-height: 38px;
    max-height: 38px;
    resize: none;
    overflow-y: auto;
}


/* =========================
   ACTION COLUMN
========================= */

td:last-child {
    white-space: nowrap;
    vertical-align: middle;
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
   FORM
========================= */

.form-group {
    margin-bottom: 16px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-size: 14px;
    font-weight: 600;
    color: #444;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ddd;
    border-radius: 7px;
    font-size: 14px;
    outline: none;
}

.form-group textarea {
    resize: vertical;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    border-color: #4f46e5;
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


/* =========================
   LOGOUT BUTTON
========================= */

.logout-link {
    width: 100%;
    background: none;
    border: none;
    color: #fff;
    text-align: left;
    padding: 12px 15px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 10px;
    transition: .3s;
}

.logout-link:hover {
    background: #3B82F6;
}


/* =========================
   CONFIRM BUTTON
========================= */

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

@media (max-width: 768px) {

    .sidebar {
        width: 200px;
        padding: 20px;
    }

    .table-container {
        margin: 20px;
        padding: 20px;
    }

    .navbar {
        padding: 15px 20px;
    }

}

</style>

</head>

<body>


<div class="container">


    <!-- =========================
         SIDEBAR
    ========================== -->

    <?php include('includes\sidebar.php'); ?>


    <!-- =========================
         MAIN
    ========================== -->

    <main class="main">


        <!-- =========================
             NAVBAR
        ========================== -->

        <?php include('includes\navbar.php'); ?>


        <!-- =========================
             TASK TABLE
        ========================== -->

        <div class="table-container">

            <div class="table-header">

                <h2>My Tasks</h2>

                <button
                    type="button"
                    class="add-btn"
                    onclick="openTaskModal()">

                    + Add Task

                </button>

            </div>


            <div class="table-wrapper">

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

                    <?php

                    $query = "SELECT *
                              FROM tasks
                              WHERE active = '1'
                              AND user_id = '$user_id'";

                    $res = mysqli_query($conn, $query);


                    if (mysqli_num_rows($res) > 0) {

                        $id = 1;

                        while ($row = mysqli_fetch_assoc($res)) {

                    ?>

                    <tr>


                        <!-- ID -->

                        <td>

                            <?php echo $id; ?>

                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo $row['id']; ?>">

                        </td>


                        <!-- TITLE -->

                        <td>

                            <span class="task-text">

                                <?php
                                echo htmlspecialchars($row['title']);
                                ?>

                            </span>


                            <input
                                type="text"
                                name="title"
                                class="edit-input"
                                value="<?php
                                    echo htmlspecialchars($row['title']);
                                ?>"
                                style="display:none;">

                        </td>


                        <!-- DESCRIPTION -->

                        <td>

                            <span class="task-text">

                                <?php
                                echo htmlspecialchars($row['description']);
                                ?>

                            </span>


                            <textarea
                                name="description"
                                class="edit-input"
                                style="display:none;"><?php
                                    echo htmlspecialchars($row['description']);
                                ?></textarea>

                        </td>


                        <!-- STATUS -->

                        <td>

                            <span class="task-text">

                                <?php

                                if ($row['status'] == 1) {

                                    echo '<span class="pending">Pending</span>';

                                } else {

                                    echo '<span class="completed">Completed</span>';

                                }

                                ?>

                            </span>


                            <select
                                name="status"
                                class="edit-input"
                                style="display:none;">

                                <option
                                    value="1"
                                    <?php
                                    if ($row['status'] == 1) {
                                        echo 'selected';
                                    }
                                    ?>>

                                    Pending

                                </option>

                                <option
                                    value="2"
                                    <?php
                                    if ($row['status'] == 2) {
                                        echo 'selected';
                                    }
                                    ?>>

                                    Completed

                                </option>

                            </select>

                        </td>


                        <!-- DATE -->

                        <td>

                            <span class="task-text">

                                <?php
                                echo htmlspecialchars($row['date']);
                                ?>

                            </span>


                            <input
                                type="date"
                                name="date"
                                class="edit-input"
                                value="<?php
                                    echo htmlspecialchars($row['date']);
                                ?>"
                                style="display:none;">

                        </td>


                        <!-- ACTION -->

                        <td>

                            <button
                                type="button"
                                class="edit-btn"
                                onclick="editTask(this)">

                                Edit

                            </button>


                            <a
                                href="javascript:void(0);"
                                class="delete-btn"
                                onclick="openDeleteModal(<?php
                                    echo $row['id'];
                                ?>)">

                                Delete

                            </a>


                            <button
                                type="button"
                                class="update-btn"
                                onclick="updateTask(this)"
                                style="display:none;">

                                Update

                            </button>

                        </td>


                    </tr>


                    <?php

                            $id++;

                        }

                    } else {

                        echo '<tr>
                                <td colspan="6">
                                    There is no Data...
                                </td>
                              </tr>';

                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>



<!-- ==================================================
     ADD TASK MODAL
=================================================== -->

<div id="taskModal" class="modal">

    <div class="modal-content">


        <div class="modal-header">

            <h2>Add New Task</h2>

            <button
                type="button"
                class="close-btn"
                onclick="closeTaskModal()">

                &times;

            </button>

        </div>


        <form action="/To-Do/add_task.php" method="POST">


            <div class="form-group">

                <label>Title</label>

                <input
                    type="text"
                    name="title"
                    placeholder="Enter task name"
                    required>

            </div>


            <div class="form-group">

                <label>Description</label>

                <textarea
                    name="description"
                    rows="4"
                    placeholder="Enter task description"
                    required></textarea>

            </div>


            <div class="form-group">

                <label>Status</label>

                <select name="status">

                    <option value="1">
                        Pending
                    </option>

                    <option value="2">
                        Completed
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Date</label>

                <input
                    type="date"
                    name="date"
                    required>

            </div>


            <div class="modal-buttons">

                <button
                    type="button"
                    class="cancel-btn"
                    onclick="closeTaskModal()">

                    Cancel

                </button>


                <button
                    type="submit"
                    name="submit"
                    class="save-btn">

                    Add Task

                </button>

            </div>


        </form>

    </div>

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



<!-- ==================================================
     DELETE MODAL
=================================================== -->

<div class="modal" id="deleteModal">

    <div class="modal-content">

        <div class="modal-header">

            <h2>Delete</h2>

            <button
                type="button"
                class="close-btn"
                onclick="closeDeleteModal()">

                &times;

            </button>

        </div>


        <p>
            Are you sure you want to Delete?
        </p>


        <div class="modal-buttons">

            <button
                class="cancel-btn"
                onclick="closeDeleteModal()">

                Cancel

            </button>


            <a
                href="#"
                id="confirmDeleteBtn"
                class="confirm-btn">

                Delete

            </a>

        </div>

    </div>

</div>



<script>

/* ==================================================
   ADD TASK MODAL
=================================================== */

function openTaskModal() {

    document.getElementById("taskModal").style.display = "flex";

}


function closeTaskModal() {

    document.getElementById("taskModal").style.display = "none";

}


/* ==================================================
   EDIT TASK
=================================================== */

function editTask(button) {

    const row = button.closest("tr");


    // Hide normal text
    row.querySelectorAll(".task-text").forEach(function(element) {

        element.style.display = "none";

    });


    // Show edit fields
    row.querySelectorAll(".edit-input").forEach(function(element) {

        element.style.display = "inline-block";

    });


    // Hide Edit button
    button.style.display = "none";


    // Hide Delete button
    row.querySelector(".delete-btn").style.display = "none";


    // Show Update button
    row.querySelector(".update-btn").style.display = "inline-block";

}


/* ==================================================
   UPDATE TASK
=================================================== */

function updateTask(button) {

    const row = button.closest("tr");


    const id =
        row.querySelector('input[name="id"]').value;


    const title =
        row.querySelector('input[name="title"]').value;


    const description =
        row.querySelector('textarea[name="description"]').value;


    const status =
        row.querySelector('select[name="status"]').value;


    const date =
        row.querySelector('input[name="date"]').value;


    /*
       Create a form dynamically
       and submit it to this same page.
    */

    const form = document.createElement("form");

    form.method = "POST";

    form.action = "";


    const fields = {

        update_task: "1",

        id: id,

        title: title,

        description: description,

        status: status,

        date: date

    };


    for (const name in fields) {

        const input = document.createElement("input");

        input.type = "hidden";

        input.name = name;

        input.value = fields[name];

        form.appendChild(input);

    }


    document.body.appendChild(form);

    form.submit();

}


/* ==================================================
   LOGOUT MODAL
=================================================== */

function openLogoutModal() {

    document.getElementById("logoutModal").style.display = "flex";

}


function closeLogoutModal() {

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


/* ==================================================
   DELETE MODAL
=================================================== */

function openDeleteModal(id) {

    document.getElementById("deleteModal").style.display = "flex";

    document.getElementById("confirmDeleteBtn").href =
        "/To-Do/delete.php?id=" + id;

}


function closeDeleteModal() {

    document.getElementById("deleteModal").style.display = "none";

}

</script>

</body>

</html>
