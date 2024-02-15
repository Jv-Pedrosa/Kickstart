<?php include('db_connect.php');?>
<?php
$qry = $conn->query("SELECT * FROM vacancy ");
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
?><center>
    <br>
    <H2>WELCOME <?php 
echo $_SESSION['login_name']; ?></H2>
</center>
<br>
<div class="container-fluid" style="width: 150%;">

    <div class="col-lg-12">
        <div class="row">

            <!-- Table Panel -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <span>
                                    <h2><b>Application List for
                                            <?php echo $_SESSION['login_name']  ?> <a href="printApp.php"
                                                target="_blank"> <button class="btn btn-primary float-right btn-sm">
                                                    <i class="fa fa-print"></i> Print Records</button></a></b></h2>
                                </span>

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
                                <col width="3%">
                                <col width="30%">
                                <col width="20%">
                                <col width="30%">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Applied</th>
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
								$login_name = $_SESSION['login_name'];
								$awhere = ""; 
								
								if ($login_name !== "Administrator") {
									// If login_name is not ADMIN
									$awhere .= empty($awhere) ? " WHERE v.position LIKE '%$login_name%' " : " AND v.position LIKE '%$login_name%' ";
								}
								$application = $conn->query("SELECT a.*,v.position FROM application a inner join vacancy v on v.id = a.position_id $awhere order by a.id asc");
							    while ($row = $application->fetch_assoc()):
								?>



                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                       
                                            <b><?php echo ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?></b>
                    
                        
                                        <td class="text-center">
                                        <b><?php echo $row['position'] ?></b>
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
<style>
td {
    vertical-align: middle !important;
}

td p {
    margin: unset
}

img {
    max-width: 100px;
    max-height: :150px;
}
</style>
<script>
$('.filter_status').each(function() {
    if ($(this).attr('data-id') == '<?php echo $pid ?>')
        $(this).addClass('btn-primary')
    else
        $(this).addClass('btn-info')

})
$('table').dataTable();

// Handle the click event for the new application button
$("#new_application").click(function() {
    uni_modal("New Application", "manage_application.php", "mid-large");
});

// Use event delegation for edit, view, and delete buttons
$(document).on('click', '.edit_application', function() {
    uni_modal("Edit Application", "manage_application.php?id=" + $(this).attr('data-id'), "mid-large");
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
$('.filter_status').click(function() {
    location.href = "index.php?page=applications&pid=" + $(this).attr('data-id') +
        '&position_id=<?php echo $position_id ?>'
})
$('#position_filter').change(function() {
    location.href = "index.php?page=applications&position_id=" + $(this).val() + '&pid=<?php echo $pid ?>'
})

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
</script>