<?php include('db_connect.php');?>
<style>
    /* Add your custom CSS styles here */
    #company_table {
        background-color: lightblue; /* Change to your desired background color */
    }
</style>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">           
        </div>
    </div>
    <br>
    
    <div class="defaulttable">
        <div class="row">
            <div class="card col-lg-12">
                <div class="card-body">
                    <h2>STUDENT INFORMATION <a href="printStudent.php" target="_blank">
                        <button class="btn btn-primary float-right btn-sm" id="print_records"><i class="fa fa-print"></i> Print Records</button></a></h2>
                </div>
                
                <table id="student_table" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $users = $conn->query("SELECT * FROM student order by id asc");
                        $i = 1;
                        while($row= $users->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['firstName'] ?>, <?php echo $row['lastName'] ?></td>
                            <td><?php echo $row['email'] ?></td>
                            <td><?php echo $row['course'] ?></td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary">Action</button>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
                                        </div>
                                    </div>
                                </center>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <h2>COMPANY INFORMATION <a href="printCompany.php" target="_blank">
                    <button class="btn btn-primary float-right btn-sm" id="print_records_company"><i class="fa fa-print"></i> Print Records</button></a></h2>
            </div>
            
            <table id="company_table" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Company Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Nature of Business</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db_connect.php';
                    $users = $conn->query("SELECT * FROM company order by Cid asc");
                    $i = 1;
                    while($row= $users->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?php echo $row['Cid'] ?></td>
                        <td><?php echo $row['companyName'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['city'] ?></td>
                        <td><?php echo $row['nature'] ?></td>
                        <td>
                            <center>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary">Action</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['Cid'] ?>'>Edit</a>
<div class="dropdown-divider"></div>
<a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['Cid'] ?>'>Delete</a></div>
                                </div>
                            </center>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize DataTables for both tables
    $('#student_table, #company_table').DataTable();

    // Add export buttons to both tables
    TableExport(document.querySelectorAll("#student_table, #company_table"), {
        formats: ["xlsx"], // Add other formats as needed
        filename: "table_data",
        sheetname: "sheet1",
    });

    // When "Company Records" button is clicked, hide the default table and show the company information
    $('#show_company_records').click(function() {
        $('.defaulttable').hide();
        $('.companyInfo').show();
    });
    
    // When "Student Records" button is clicked, hide the company information and show the default table
    $('#show_student_records').click(function() {
        $('.companyInfo').hide();
        $('.defaulttable').show();
    });
});
</script>
