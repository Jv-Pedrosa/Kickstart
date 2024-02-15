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

    if(isset($_POST['submit'])){
        $position = $_POST['position'];
        $description = $_POST['description'];
        $firstname = $_SESSION['UserFirstName']; // Add a semicolon here
        $companyid = $_SESSION['companyId']; // Add a semicolon here
   
    
        // Prepare the SQL INSERT statement with the correct variable names
        $sql = "INSERT INTO `vacancy1`(`position`,`description`,`companyname`,`companyId`)
                VALUES ('$position','$description','$firstname','$companyid')";
    
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }
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
    .wrapper {
    z-index: 100;
    border: 1px solid grey;
    box-shadow: 10px 0px 5px -5px rgba(0, 0, 0, 0.5);
    width: 800px;
    overflow: hidden;
    padding: 80px;
    border-radius: 8px;
    background: #fff;
    position: absolute;
    left: 50%;
    top: 150px;
    transform: translateX(-50%);
}


    .pass-field {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .pass-field textarea {
        width: 100%;
        height: 100%;
        outline: none;
        padding: 10px;
        font-size: 1.3rem;
        border-radius: 5px;
        border: 1px solid #999;
        resize: none; /* Prevent textarea from being resizable */
    }

    .pass-field textarea:focus {
        border: 2px solid #4285f4;
    }
    th {
        background-color: #999; /* Change to your desired color */
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
            <a class="navbar-brand js-scroll-trigger" href="index1.php"> KICKSTART</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="companyindex.php">HOME</a></li>

                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="companyPost.php">MY POSTINGS</a></li>

                    <li class="nav-item"><a class="nav-link js-scroll-trigger" id="logout" href="login.php">LOGOUT<i class="fa fa-power-off"></i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">
    <table id="student_table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">Recent Post</th>

                        <?php
                        include 'admin/db_connect.php';
                        $companyId = $_SESSION['companyId'];
                        $users = $conn->query("SELECT * FROM vacancy1 WHERE companyId = '$companyId'");
                        $i = 1;
                        while($row= $users->fetch_assoc()):
                        ?>
                        <tr>
                            <td><h1><?php echo $row['companyname'] ?></h1>
                                <u><?php echo $row['position'] ?></u>
                                <br/><br/>
                                <?php echo $row['description'] ?>
                                
                    
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <div class="container">

    </div>
    <div class="modal fade" id="uni_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
    <div class="small text-center text-muted">Welcome - KICKSTART ©2024</div>
    <footer>
        <?php include('footer.php') ?>
    </footer>
</body>
<?php $conn->close() ?>
</html>
<script>
    $("#new_vacancy").click(function() {
        uni_modal("New Vacancy", "create_vacancy.php", "mid-large");
    });

    $("#logout").click(function(event) {
        var confirmLogout = window.confirm("Are you sure you want to logout?");
        if (!confirmLogout) {
            event.preventDefault();
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        var logoutLink = document.getElementById("logout"); // Get the logout link by its ID
        if (logoutLink) { // Check if the logout link exists
            logoutLink.addEventListener("click", function(event) {
                var confirmLogout = confirm("Are you sure you want to logout?"); // Show confirmation dialog
                if (!confirmLogout) {
                    event.preventDefault(); // Prevent the default action (navigation) if user cancels
                }
                // If the user confirms, the link will proceed to navigate to "../login.php"
            });
        }
    });
</script>
