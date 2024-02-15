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
$sql = "SELECT * FROM users";
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
                        <button class="Button Button--outline" onclick="printDiv()">Print</button>
                        <button class="Button Button--outline" onclick="exportToExcel()">Export to Excel</button>
                        <form action="" method="get">
                            <label for="typeFilter">Filter by Type:</label>
                            <select name="typeFilter" id="typeFilter" onchange="updateLabel()">
                                <option value="all"
                                    <?php echo isset($_GET['typeFilter']) && $_GET['typeFilter'] == 'all' ? 'selected' : ''; ?>>All
                                </option>
                                <option value="1"
                                    <?php echo isset($_GET['typeFilter']) && $_GET['typeFilter'] == '1' ? 'selected' : ''; ?>>Admin
                                </option>
                                <option value="2"
                                    <?php echo isset($_GET['typeFilter']) && $_GET['typeFilter'] == '2' ? 'selected' : ''; ?>>Company
                                </option>
                                <option value="3"
                                    <?php echo isset($_GET['typeFilter']) && $_GET['typeFilter'] == '3' ? 'selected' : ''; ?>>Student
                                </option>
                            </select>
                            <input type="submit" value="Filter">
                        </form>
                        <p> content content content </p>
                        <div id="printableTable">
                            <?php
                                // Your PHP code for displaying the table goes here
                                // ...

                                // Example table
                                echo "<table border='1' style='border: 1px solid black; border-collapse: collapse;' class='table table-bordered table-hover'>";
                                echo "<tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>UserName</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Type</th>
                                      </tr>";
                                // Output data of each row
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row["id"] . "</td>
                                            <td>" . $row["name"] . "</td>
                                            <td>" . $row["username"] . "</td>
                                            <td>" . $row["firstname"] . "</td>
                                            <td>" . $row["lastname"] . "</td>";
                                    switch ($row["type"]) {
                                        case 1:
                                            echo "<td>Admin</td>";
                                            break;
                                        case 2:
                                            echo "<td>Company</td>";
                                            break;
                                        case 3:
                                            echo "<td>Student</td>";
                                            break;
                                        default:
                                            echo "<td>Unknown</td>";
                                            break;
                                    }
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
            a.download = 'table_data.xls';
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
