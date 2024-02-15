<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
     foreach ($query as $key => $value) {
      if(!is_numeric($key))
        $_SESSION['setting_'.$key] = $value;
    }
    ob_end_flush();
    include('header.php');

	
    ?>

<style>
body {
    animation: transitionIn 1s;
}


@keyframes transitionIn {
    from {
        opacity: 0;
        transform: rotateX(-10deg);
    }

    to {
        opacity: 1;
        transform: rotateX(0);
    }
}

header.masthead {
    background: url(admin/assets/img/1705742880_papers-laptop-office-table_23-2147772284.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}

#mainNav .navbar-nav .nav-item .nav-link {
    color: orange;
    padding: 0 1rem;
}
</style>

<body id="page-top">
    <!-- Navigation-->
    <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-4" id="mainNav">
        <div class="container">
            <div class="logo" style="width: 30px">
                <span class="fa fa-shoe-prints"></span>
            </div>
            <a class="navbar-brand js-scroll-trigger" href="./"> KICKSTART</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=home">HOME</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=about">ABOUT</a>
                    </li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login.php"><i
                                class=" fa fa-user-plus"></i>STUDENT LOGIN</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="companyLogin.php"><i
                                class=" fa fa-building"></i>COMPANY LOGIN</a></li>


                </ul>
            </div>
        </div>
    </nav>

    <?php 
        $page = isset($_GET['page']) ?$_GET['page'] : "home";
        include $page.'.php';
        ?>


    <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                </div>
                <div class="modal-body">
                    <div id="delete_content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit'
                        onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="fa fa-arrow-righ t"></span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <div id="preloader"></div>
    <footer class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="mt-0">Contact us</h2>
                    <hr class="divider my-4" />
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                    <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                    <div><?php echo $_SESSION['setting_contact'] ?></div>
                </div>
                <div class="col-lg-4 mr-auto text-center">
                    <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                    <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                    <a class="d-block"
                        href="https://mail.google.com/mail/u/0/?fs=1&to=kickstart123@gmail.com&tf=cm">kickstart123@gmail.com</a>
                </div>
            </div>
        </div>

        <br>
        <div class="container">
            <div class="small text-center text-muted">Welcome - KICKSTART ©2024
    </footer>

    <?php include('footer.php') ?>
</body>

<?php $conn->close() ?>

</html>
