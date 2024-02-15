<?php
session_start();
    include('db_connect.php');
    ob_start();
   /* if(isset($_SESSION['UserLogin'])){
    echo $_SESSION['UserLogin']; // Echo the user's name stored in the session
} else {
    echo "No user is logged in";
}
*/$qry = $conn->query("SELECT * FROM vacancy ");
	while($row=$qry->fetch_assoc()){
		$pos[$row['id']] = $row['position'];
	}
	$pid = 'all';
	if(isset($_GET['pid']) && $_GET['pid'] >= 0){
		$pid = $_GET['pid'];
	}
	$position_id = 'all';
	if(isset($_GET['position_id']) && $_GET['position_id'] >= 0){
		$position_id = $_GET['position_id'];
	}
 include('header.php');

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
.modal-dialog.large {
    width: 80% !important;
    max-width: unset;
}

.modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
}

#navbarResponsive {
    font-weight: 650;
}

body {
    animation: transitionIn 0.75s;
    margin: 0;
    font-family: "Merriweather", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    text-align: left;
    background-color: #fff;
    overflow-x: hidden;
}

@keyframes transitionIn {
    from {
        opacity: 0;
        transform: rotateX(-20deg);
    }

    to {
        opacity: 1;
        transform: rotateX(0);
    }
}

header.masthead {
    background: url(assets/img/1705742880_papers-laptop-office-table_23-2147772284.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}

#mainNav .navbar-nav .nav-item .nav-link {
    color: orange;
    padding: 0 1rem;
}

nav#mainNav {
    background: #00000099;
    color: white;
}

#mainNav .navbar-brand {
    color: white;
    font-weight: 650;
}
}
</style>

<body>

    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>



    <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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

            <a class="navbar-brand js-scroll-trigger" href="../index1.php"> KICKSTART</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="jobs.php?page=job">JOBS
                            APPLICATION </a>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index1.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../index1.php?page=about">ABOUT</a>
                    </li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" id="logout" href="../login.php">LOGOUT<i
                                class="fa fa-power-off"></i></a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
    <br><br><br><br><br>
    <br><br>
    <div class="container-fluid" style="width: 100%;">
        <div style="position: relative; width: 100%; height: 100px;">
            <center>
                <h1 style="font-style: italic; font-size: 56px; "> WELCOME

                <span style="color: #FFA07A; font-weight: bold;"><?php echo $_SESSION['UserFirstName']; ?> <?php echo $_SESSION['UserLastName']; ?> ! </span>   </center>
        </div>

        </h1>
        <BR>
        <div class="col-lg-12">
            <div class="row">

                <!-- Table Panel -->
                <div class="col-lg-8" style="margin-left: 20%;">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-12">
                                    <span>
                                        <large><b>Your Job List Application
                                            </b></large>
                                    </span>

                                    <a href="../index1.php?=result.php#findjob">
                                        <button class="btn btn-sm btn-block btn-primary btn-sm col-md-2 float-right"
                                            type="button"><i class="fa fa-plus"></i> Add More Application</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body" style="font-size: 15px">
                            <div class="row">
                                <div class="col-lg-12">

                                </div>
                            </div>

                            <table class="table table-bordered table-hover">
                                <colgroup>
                                    <col width="10%">
                                    <col width="30%">
                                    <col width="20%">
                                    <col width="30%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Applicant Information</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
								$i = 1;
								$stats = $conn->query("SELECT * FROM recruitment_status order by id asc");
								$stat_arr[0] = "New";
								while ($row = $stats->fetch_assoc()) {
									$stat_arr[$row['id']] = $row['status_label'];
								}
								$awhere = '';
								if(isset($_GET['pid']) && $_GET['pid'] >= 0){
									$awhere = " where a.process_id = '".$_GET['pid']."' ";
								}
								if(isset($_GET['position_id']) && $_GET['position_id'] > 0){
									if(empty($awhere))
									$awhere = " where a.position_id = '".$_GET['position_id']."' ";
									else
									$awhere .= " and a.position_id = '".$_GET['position_id']."' ";

								}
								
                $UserLogin = $_SESSION['UserLogin'];
								$awhere = ""; 
								
								if ($UserLogin !== "Administrator") {
    
                  $login_name_sanitized = $conn->real_escape_string($UserLogin);
                  $awhere .= empty($awhere) ? " WHERE a.hidden = '$login_name_sanitized' " : " AND a.hidden = '$login_name_sanitized' ";
                                              }
                    $application = $conn->query("SELECT a.*, v.position FROM application a INNER JOIN vacancy v ON v.id = a.position_id $awhere ORDER BY a.id ASC");
                                  while ($row = $application->fetch_assoc()):
                              ?>


                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td class="">
                                            <p>Name :
                                                <b><?php echo ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?></b>
                                            </p>
                                            <p>Applied for : <b><?php echo $row['position'] ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $stat_arr[$row['process_id']] ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-primary view_application" type="button"
                                                data-id="<?php echo $row['id'] ?>">View</button>
                                            <button class="btn btn-sm btn-primary edit_application" type="button"
                                                data-id="<?php echo $row['id'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-danger delete_application" type="button"
                                                data-id="<?php echo $row['id'] ?>">Delete</button>

                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Table Panel -->
            </div>
        </div>

    </div>

</body>

</html>
<script>
$('.filter_status').each(function() {
    if ($(this).attr('data-id') == '<?php echo $pid ?>')
        $(this).addClass('btn-primary')
    else
        $(this).addClass('btn-info')

})


// Handle the click event for the new application button
$("#new_application").click(function() {
    uni_modal("New Application", "manage_application.php", "mid-large");
});

// Use event delegation for edit, view, and delete buttons
$(document).on('click', '.edit_application', function() {
    uni_modal("Edit Application", "manage_application1.php?id=" + $(this).attr('data-id'), "mid-large");
});

$(document).on('click', '.view_application', function() {
    uni_modal("", "view_application.php?id=" + $(this).attr('data-id'), "mid-large");
});

$(document).on('click', '.delete_application', function() {
    _conf("Are you sure to delete this Applicant?", "delete_application", [$(this).attr('data-id')]);
});


function displayImg(input, _this) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


function delete_application($id) {
    start_load()
    $.ajax({
        url: 'ajax.php?action=delete_application',
        method: 'POST',
        data: {
            id: $id
        },
        success: function(resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'success')
                setTimeout(function() {
                    location.reload()
                }, 1500)

            }
        }
    })
}

window.start_load = function() {
    $('body').prepend('<di id="preloader2"></di>')
}
window.end_load = function() {
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
    })
}

window.uni_modal = function($title = '', $url = '', $size = "") {
    start_load()
    $.ajax({
        url: $url,
        error: err => {
            console.log()
            alert("An error occured")
        },
        success: function(resp) {
            if (resp) {
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                if ($size != '') {
                    $('#uni_modal .modal-dialog').addClass($size)
                } else {
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                }
                $('#uni_modal').modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false,
                    focus: true
                })
                end_load()
            }
        }
    })
}
window._conf = function($msg = '', $func = '', $params = []) {
    $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
    $('#confirm_modal .modal-body').html($msg)
    $('#confirm_modal').modal('show')
}
window.alert_toast = function($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-warning')

    if ($bg == 'success')
        $('#alert_toast').addClass('bg-success')
    if ($bg == 'danger')
        $('#alert_toast').addClass('bg-danger')
    if ($bg == 'info')
        $('#alert_toast').addClass('bg-info')
    if ($bg == 'warning')
        $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({
        delay: 3000
    }).toast('show');
}
$(document).ready(function() {
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
    })
})
$('.datetimepicker').datetimepicker({
    format: 'Y/m/d H:i',
    startDate: '+3d'
})
$('.select2').select2({
    placeholder: "Please select here",
    width: "100%"
})

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