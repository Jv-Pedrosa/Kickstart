<style>
nav#sidebar {
    height: calc(100%);
    position: fixed;
    z-index: 99;
    left: 0;
    width: 250px;
    background-image: url('assets/img/admin.png');
    background-repeat: no-repeat;
    background-size: 300px 250px;
    background-position: bottom;
}
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark'>

    <div class="sidebar-list">


        <a href="index.php?page=applications" class="nav-item nav-applications"><span class='icon-field'><i
                    class="fa fa-user-tie"></i></span> Applications</a>
        <a href="index.php?page=vacancy" class="nav-item nav-vacancy"><span class='icon-field'><i
                    class="fa fa-list-alt"></i></span> Edit Company</a>
        <a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i
                    class="fa fa-border-all"></i></span> Overall Status</a>
        <?php if($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i
                    class="fa fa-users"></i></span> Users</a>




        <?php endif; ?>
    </div>

</nav>
<script>
$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>