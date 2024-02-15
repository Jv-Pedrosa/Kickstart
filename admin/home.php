<?php include 'db_connect.php' ?>
<?php 
 $query = "SELECT vacancy.position, COUNT(application.id) as application_count FROM vacancy INNER JOIN application ON vacancy.id = application.position_id GROUP BY vacancy.position";
$result = $conn->query($query);
$positionsData = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $positionsData[] = [$row["position"], (int)$row["application_count"]];
    }
} else {
    echo "No matching vacancies found";
}


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
.chart-container {
    display: flex;

    align-items: center;
}

/* Modal Style */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0, 0, 0);
    background-color: rgba(0, 0, 0, 0.4);

}

/* Modal Content */
.modal-content {
    text-align: center;
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    color: black;

}


.close {
    color: #aaa;
    margin-left: 90%;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

<div class="containe-fluid" id="printableArea">

    <body style="">
        <div class="row">
            <div class="col-lg-12">

            </div>
        </div>

        <div class="row mt-3 ml-3 mr-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php echo "Welcome back ". $_SESSION['login_name']."!"  ?>
                        <button onclick="printDiv('printableArea')" style="text-align: left; margin-left: 70%;">Print
                            Content</button>
                    </div>
                    <hr>
                    <h2><i>
                            <center>ALL APPLICATION STATUS<i></center>
                    </h2>
                    <center>
                        <p id="currentDate">Loading date...</p>

                    </center>

                    <?php if (isset($_SESSION['login_name']) && $_SESSION['login_name'] === "Administrator") { ?>

                    <div class="row ml-2 mr-2">
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">

                                <div class="card-body" style="background-color: white; color: black;">

                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">Active JOB Vacancies</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM vacancy where status = 1  ");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>
                                        <a href="index.php?page=vacancy">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-body" style="background-color: rgb(51, 102, 204);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">New Applicants</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                    // Query the database for applicants with process_id = 0
                                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 0");
                                    // Display the number of applicants
                                    echo $applicants->num_rows;
                                    ?>
                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 0");
                    echo '<i class="fa fa-user-tie" style="cursor: pointer;" onclick="openModal(\'modalAllResumes\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes\')">&times;</span>
                                    <h2>Downloadable Resumes for New Applicants</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download_all.php" class="button">Download All Resumes (FOR NEW APPLICANTS)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "No applicants found with process_id = 0.";
                    }
                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body" style="background-color: rgb(221, 68, 119);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">For Initial Interview</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 1");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 1");
                    echo '<i class="fa fa-italic" style="cursor: pointer;" onclick="openModal(\'modalAllResumes1\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes1" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes1\')">&times;</span>
                                    <h2>Downloadable Resumes for Initial Interview</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download1.php" class="button">Download All Resumes (FOR INITIAL INTERVIEW)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "No applicants found with process_id = 0.";
                    }
                    ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body" style="background-color: rgb(255, 153, 0);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">For Final Interview</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 4");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 4");
                    echo '<i class="fa fa-fire" style="cursor: pointer;" onclick="openModal(\'modalAllResumes2\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes2" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes2\')">&times;</span>
                                    <h2>Downloadable Resumes for Final Interview</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download2.php" class="button">Download All Resumes (FOR Final Interview)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "No applicants found with process_id = 0.";
                    }
                    ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body" style="background-color: rgb(16, 150, 24);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">Passed Final Interview</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 5");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 5");
                    echo '<i class="fa fa-check" style="cursor: pointer;" onclick="openModal(\'modalAllResumes3\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes3" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes3\')">&times;</span>
                                    <h2>Downloadable Resumes for Final Interview</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download3.php" class="button">Download All Resumes (FOR Final Interview)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "No applicants found with process_id = 0.";
                    }
                    ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class=" col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body" style="background-color: rgb(153, 0, 153);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">Failed Final Interview
                                            </div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 6 ");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 6");
                    echo '<i class="fa fa-times" style="cursor: pointer;" onclick="openModal(\'modalAllResumes4\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes4" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes4\')">&times;</span>
                                    <h2>Downloadable Resumes for Final Interview</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download4.php" class="button">Download All Resumes (FOR Final Interview)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "";
                    }
                    ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body" style="background-color: rgb(0, 153, 198);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">Hired</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 9");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 9");
                    echo '<i class="fa fa-briefcase" style="cursor: pointer;" onclick="openModal(\'modalAllResumes5\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes5" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes5\')">&times;</span>
                                    <h2>Downloadable Resumes for Final Interview</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download5.php" class="button">Download All Resumes (FOR Final Interview)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "";
                    }
                    ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white mb-3">
                                <div class="card-body" style="background-color: rgb(220, 57, 18);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="mr-3">
                                            <div class="text-white-75 small">Withdraw/Failed</div>
                                            <div class="text-lg font-weight-bold">
                                                <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 10");
                                            echo $vacancies->num_rows;
                                             ?>

                                            </div>
                                        </div>

                                        <?php 
                    $applicants = $conn->query("SELECT * FROM application WHERE process_id = 10");
                    echo '<i class="fa fa-exclamation" style="cursor: pointer;" onclick="openModal(\'modalAllResumes6\')"></i>';

                    if ($applicants->num_rows > 0) {
                        echo '<div id="modalAllResumes6" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeModal(\'modalAllResumes6\')">&times;</span>
                                    <h2>Downloadable Resumes for Final Interview</h2>';

                        while ($applicant = $applicants->fetch_assoc()) {
                            $applicantId = $applicant['id'];
                            $resumePath = $applicant['resume_path'];
                            if (!empty($resumePath) && file_exists("assets/resume/" . $resumePath)) {
                                // List each downloadable resume inside the modal
                                        echo '<div style="text-align: left; margin-left: 10%;">' . 
                    '<p>' . htmlspecialchars($applicant['firstname']) . ' ' . htmlspecialchars($applicant['lastname']) . 
                    ': <a href="download.php?id=' . $applicantId . '" target="_blank">Download</a></p>' . 
                    '</div>';
            }
                                    }
                echo '<a href="RESUME/download6.php" class="button">Download All Resumes (FOR Final Interview)</a>';
                        // Close the modal structure
                        echo '</div></div>';
                    } else {
                        echo "";
                    }
                    ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <a href="RESUME/allresume.php"
                        style="text-align: left; margin-left: 84%; display: inline-block; padding: 8px 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
                        DOWNLOAD ALL RESUMES
                    </a>

                    <?php } ?>
                    <div class="chart-container">

                        <?php
                    if (isset($_SESSION['login_name']) && $_SESSION['login_name'] === "Administrator") {
                        echo '
                         <div id="piechart_3d" style="width: 700px; height: 400px;"></div>
                         <div id="barchart_material" style="width: 700px; height: 300px;"></div>';
                        } else
                        echo '<h2 style="margin-left: 10%;">APPLICANTS DATA for <span style="color: orange;">' 
                        . $_SESSION['login_name'] . '</span></h2>
                        <div id="uniquepie" style="width: 700px; height: 400px;"></div> ';
                        ?>
                    </div>

                </div>
            </div>

        </div>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawChart2);

        //admin
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['NEW APLICANTS', <?php 
                                        	$applicant = $conn->query("SELECT * FROM application where process_id = 0 ");
                                        	echo $applicant->num_rows;
                                        	 ?>],
                ['WITHDRAW/FAILED', <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 10");
                                            echo $vacancies->num_rows;
                                             ?>],
                ['FOR FINAL INTERVIEW', <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 4");
                                            echo $vacancies->num_rows;
                                             ?>],
                ['PASSES FINAL INTERVIEW', <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 5");
                                            echo $vacancies->num_rows;
                                             ?>],
                ['FAILED FINAL INTERVIEW', <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 6 ");
                                            echo $vacancies->num_rows;
                                             ?>],
                ['HIRED', <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 9");
                                            echo $vacancies->num_rows;
                                             ?>],
                ['FOR INITIAL INTERVIEW', <?php 
                                            $vacancies = $conn->query("SELECT * FROM application where process_id = 1");
                                            echo $vacancies->num_rows;
                                             ?>]

            ]);

            var options = {
                title: 'APPLICANTS CHART',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
            chart.draw(data, options);
        }
        //not admin
        function drawChart2() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['NEW APLICANTS', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 0 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>],

                ['WITHDRAW/FAILED', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 10 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>],
                ['FOR FINAL INTERVIEW', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 4 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>],
                ['PASSES FINAL INTERVIEW', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 5 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>],
                ['FAILED FINAL INTERVIEW', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 6 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>],
                ['HIRED', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 9 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>],
                ['FOR INITIAL INTERVIEW', <?php 
                                    $login_name = $_SESSION['login_name'];
                                    $query = "SELECT application.* FROM application 
                                    INNER JOIN vacancy ON application.position_id = vacancy.id 
                                    WHERE application.process_id = 1 AND vacancy.position LIKE ?";
                                    $stmt = $conn->prepare($query);
                                    $like_login_name = "%" . $login_name . "%";
                                    $stmt->bind_param("s", $like_login_name); // "s" indicates the type is a string
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    echo $result->num_rows;
                                    ?>]

            ]);

            var options = {
                title: 'APPLICANTS CHART',
                is3D: true,
            };

            var chart = new google.visualization.PieChart(document.getElementById('uniquepie'));
            chart.draw(data, options);
        }
        //date
        var today = new Date();


        var dateString = today.toLocaleDateString('en-US', {
            month: 'long',
            day: 'numeric',
            year: 'numeric',
        });

        document.getElementById("currentDate").textContent = "Current Date: " + dateString;
        </script>
        <script>
        < script type = "text/javascript"
        src = "https://www.gstatic.com/charts/loader.js" >
        </script>
        <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Position', 'Applicants'],
                <?php
        foreach ($positionsData as $item) {
            echo "['" . $item[0] . "', " . $item[1] . "],";
        }
        ?>
            ]);

            var options = {
                title: 'Applications per Position',
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'Total Applications',
                    minValue: 0
                },
                vAxis: {
                    title: 'Position'
                }
            };

            var options = {
                chart: {
                    title: 'Company\'s Applicants'

                },
                bars: 'horizontal' // Required for Material Bar Charts.
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
        </script>
        <script>
        function printDiv(divId) {
            var content = document.getElementById(divId).innerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = content;
            window.print();
            document.body.innerHTML = originalContent;
        }
        </script>
        <script>
        function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target.className === "modal") {
                closeModal(event.target.id);
            }
        }
        </script>