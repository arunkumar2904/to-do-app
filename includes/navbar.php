<div class="navbar">

    <h2>Dashboard</h2>

    <div class="account">

        <div class="avatar">
            <?php  
            $str = $_SESSION['name'];
            echo substr($str,0,1); ?>
        </div>

        <div class="account-info">
            <h4><?php echo $_SESSION['name']; ?></h4>
            <p><?php echo $_SESSION['email']; ?></p>
        </div>

    </div>

</div>