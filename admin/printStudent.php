<style>
@media print {
    /* Center the table */
    table {
        margin: auto;
    }
}
</style>

<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'recruitment_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch data
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<?php
    session_start();
    if(!isset($_SESSION['login_id']))
        header('location:login.php');
    include('./header.php'); 
    // include('./auth.php'); 
 ?>

<?php include('db_connect.php');?>


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
                        

                        <div id="printableTable">
                            <?php
                                // Your PHP code for displaying the table goes here
                                // ...

                                // Example table
                                echo "<table border='1' style='border: 1px solid black; border-collapse: collapse;' class='table table-bordered table-hover'>";
                                echo "<tr>
                                        <th>ID</th>
                                        <th>Last Name</th>
                                        <th>First Name</th>
                                        <th>Course</th>
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                      </tr>";
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["lastName"] . "</td>
                                        <td>" . $row["firstName"] ."</td>   
                                        <td>" . $row["course"] . "</td>
                                        <td>" . $row["email"] . "</td>
                                        <td>" . $row["cpNum"] . "</td>";
                                    echo "</tr>";

                                }
                                echo "</table>";
                            ?>
                        </div>
                        <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printDiv() {
            window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
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
            a.download = 'Student_records.xls';
            a.click();
        }

        function updateLabel() {
            var selectBox = document.getElementById("typeFilter");
            var selectedValue = selectBox.options[selectBox.selectedIndex].text;
            if (selectedValue === '1') {
                selectedValue = 'Admin';
            } else if (selectedValue === '2') {
                selectedValue = 'Company';
            } else if (selectedValue === '3') {
                selectedValue = 'Student';
            }
        }
    </script>
