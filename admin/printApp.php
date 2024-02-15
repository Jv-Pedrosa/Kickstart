<?php
    session_start();
    if(!isset($_SESSION['login_id']))
        header('location:login.php');
    include('./header.php'); 
    // include('./auth.php'); 

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'recruitment_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $search = isset($_GET['search']) ? $_GET['search'] : '';

    // Fetch vacancy positions
    $qry = $conn->query("SELECT * FROM vacancy ");
    while ($row = $qry->fetch_assoc()) {
        $pos[$row['id']] = $row['position'];
    }

    $pid = 'all';
    if (isset($_GET['pid']) && $_GET['pid'] >= 0) {
        $pid = $_GET['pid'];
    }

    $position_id = 'all';
    if (isset($_GET['position_id']) && $_GET['position_id'] >= 0) {
        $position_id = $_GET['position_id'];
    }
?>

<center><br></center><br>
<div class="container-fluid" style="width: 150%;">
    <div class="col-lg-12">
        <div class="row">
            <!-- Table Panel -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <span></span>
                            </div>
                        </div>
                        <button class="Button Button--outline" onclick="printDiv()">Print to PDF</button>
                        <button class="Button Button--outline" onclick="exportToExcel()">Export to Excel</button>
                    </div>
                    <div class="card-body" style="font-size: 15px">
                        <div class="row">
                            <div class="col-lg-12"></div>
                        </div>
                        <div id="printableTableContainer">
                            <div id="printableTable">
                                <table border="1" class="table table-bordered table-hover">
                                    <colgroup>
                                        <col width="3%">
                                        <col width="30%">
                                        <col width="20%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Applicant Name</th>
                                            <th class="text-center">Company Name</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Contact#</th>
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
                                            if (isset($_GET['pid']) && $_GET['pid'] >= 0) {
                                                $awhere = " where a.process_id = '" . $_GET['pid'] . "' ";
                                            }
                                            if (isset($_GET['position_id']) && $_GET['position_id'] > 0) {
                                                if (empty($awhere))
                                                    $awhere = " where a.position_id = '" . $_GET['position_id'] . "' ";
                                                else
                                                    $awhere .= " and a.position_id = '" . $_GET['position_id'] . "' ";
                                            }
                                            if (!empty($search)) {
                                                if (empty($awhere))
                                                    $awhere = " where (a.lastname like '%$search%' or a.firstname like '%$search%' or a.middlename like '%$search%') ";
                                                else
                                                    $awhere .= " and (a.lastname like '%$search%' or a.firstname like '%$search%' or a.middlename like '%$search%') ";
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
                                            </td>
                                            <td class="text-center">
                                                <b><?php echo $row['position'] ?></b>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $stat_arr[$row['process_id']] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['email'] ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['contact'] ?>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
</div>
<script>
    function printDiv() {
        window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTableContainer").innerHTML;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
    }

    function exportToExcel() {
        var table = document.getElementById("printableTable");
        var html = table.outerHTML;

        // Format content for excel
        var uri = 'data:application/vnd.ms-excel;base64,';

        // Set filename
        var ctx = {
            worksheet: 'TableData'
        };
        var a = document.createElement('a');
        a.href = uri + btoa(html);
        a.download = 'Applications_data.xls';
        a.click();
    }
</script>
