<?php 
include 'admin/db_connect.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $course = $_POST['program'];
    $cpNum = $_POST['cpNum']; // Get the selected course

    // Prepare the SQL INSERT statement with the course included
    $sql = "INSERT INTO `student`(`email`,`password`,`firstname`,`lastname`,`course`,`empStatus`,`cpNum`)
            VALUES ('$email','$password','$firstname','$lastname','$course','1','$cpNum')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn); // Use $conn instead of $con
    }

    // Redirect to login page after insertion
    header("Location: login.php");
    exit; // Terminate script execution after redirection
}
?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Password Validation Check | CodingNepal</title>
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Fontawesome Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <style>
    /* Import Google font - Poppins */
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        background: white;
    }

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


    h1 {}

    .wrapper {
        border: 1px solid grey;
        box-shadow: 10px 0px 5px -5px rgba(0, 0, 0, 0.5);
        width: 550px;
        overflow: hidden;
        padding: 80px;
        border-radius: 8px;
        background: #fff;

    }

    .wrapper .pass-field {
        height: 45px;
        width: 100%;
        position: relative;
    }

    .pass-field input {
        width: 100%;
        height: 100%;
        outline: none;
        padding: 0 17px;
        font-size: 1.3rem;
        border-radius: 5px;
        border: 1px solid #999;
    }

    .pass-field input:focus {
        padding: 0 16px;
        border: 2px solid #4285f4;
    }

    .pass-field i {
        right: 18px;
        top: 50%;
        font-size: 1.2rem;
        color: #999;
        cursor: pointer;
        position: absolute;
        transform: translateY(-50%);
    }

    .wrapper .content {
        margin: 20px 0 10px;
    }

    .content p {
        color: #333;
        font-size: 1rem;
    }

    .content .requirement-list {
        margin-top: 20px;
    }

    .requirement-list li {
        font-size: 1rem;
        list-style: none;
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .requirement-list li i {
        width: 20px;
        color: #aaa;
        font-size: 0.6rem;
    }

    .requirement-list li.valid i {
        font-size: 1.2rem;
        color: #4285f4;
    }

    .requirement-list li span {
        margin-left: 12px;
        color: #333;
    }

    .requirement-list li.valid span {
        color: #999;
    }

    @media screen and (max-width: 500px) {

        body,
        .wrapper {
            padding: 15px;
            border: 1px solid black;
        }

        .wrapper .pass-field {
            height: 40px;
        }

        .pass-field input,
        .content p {
            font-size: 1.15rem;
        }

        .pass-field i,
        .requirement-list li {
            font-size: 1.1rem;
        }

        .requirement-list li span {
            margin-left: 7px;
        }
    }

    #submitBtn {
        background-color: #ff7f50;
        /* Orange color */
        color: white;
        border: none;
        padding: 10px 34px;
        margin-top: 2px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1rem;
        transition: background-color 0.3s, transform 0.3s;
    }

    #submitBtn:hover {
        background-color: #e67348;
        /* Darker shade of orange for hover effect */
        transform: scale(1.05);
    }

    #submitBtn:disabled {
        background-color: #ffc1a6;
        /* Lighter orange for disabled state */
        color: #ffffff;
        cursor: not-allowed;
    }

    .back-button {
        background-color: white;
        color: black;
        border: 1px solid black;
        padding: 11px 20px;
        margin-top: 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.1rem;
        transition: background-color 0.3s, transform 0.3s;
        text-decoration: none;
    }

    .back-button:hover {
        background-color: #e67348;
        /* Darker shade of orange for hover effect */
        transform: scale(1.05);
    }

    .image-container {
        margin-left: 30px;
    }

    .pass-field select {
    width: 100%;
    height: 100%;
    outline: none;
    padding: 8px 17px; /* Adjust padding */
    font-size: 1.3rem;
    border-radius: 5px;
    border: 1px solid #999;
    margin-bottom: 10px; /* Add margin bottom to create space */
}

.pass-field select:focus {
    padding: 8px 16px; /* Adjust padding */
    border: 2px solid #4285f4;
}

/* Adjust styles for smaller screens */
@media screen and (max-width: 500px) {
    .pass-field select {
        font-size: 1.15rem;
    }
}
    </style>
</head>

<body>


    <form action="" method="post" onsubmit="displayAlert()">
        <div class="wrapper">
            <h1>Student Sign UP</h1>
            <br />
            <div class="pass-field">
                <input type="text" name="firstname" placeholder="FirstName" required>
            </div>
            <br />

            <div class="pass-field">
                <input type="text" name="lastname" placeholder="LastName" required>
            </div>
            <br />

            <div class="pass-field">
    <select id="" name="program" style="">
        <option value="">Course</option>

        <optgroup label="Sta. Mesa, Manila Branch"> 
        <optgroup label="Doctorate Degree Programs">
            <option value="Doctor of Philosophy in Communication">Doctor of Philosophy in Communication (PhD Com)</option>
            <option value="Doctor of Philosophy in Economics">Doctor of Philosophy in Economics (PhD Econ)</option>
            <option value="Doctor of Philosophy in English Language Studies">Doctor of Philosophy in English Language Studies (PhD ELS)</option>
            <option value="octor of Philosophy in Filipino">Doctor of Philosophy in Filipino (PhD Fil)</option>
            <optgroup label="Major in">
                <option value="wika">Wika</option>
                <option value="panitikan">Panitikan</option>
            </optgroup>
            <option value="phd-psy">Doctor of Philosophy in Psychology (PhD Psy)</option>
        </optgroup>
            <!-- Add specific branch programs here -->
        </optgroup>






        <optgroup label="Master's Degree Programs">
          <option value="Master in Applied Statistics">Master in Applied Statistics (MAS)</option>
          <optgroup label="Specializations">
              <option value="Data Analytics">Data Analytics</option>
              <option value="Official Statistics">Official Statistics</option>
              <option value="Statistical Methods">Statistical Methods</option>
          </optgroup>
          <option value="Master of Arts in Communication">Master of Arts in Communication (MAC)</option>
          <option value="Master of Arts in English Language Studies">Master of Arts in English Language Studies (MAELS)</option>
          <option value="Master of Arts in Filipino">Master of Arts in Filipino (MAF)</option>
          <optgroup label="Major in">
              <option value="Wika">Wika</option>
              <option value="Panitikan">Panitikan</option>
          </optgroup>
          <option value="Master of Arts in Philippine Studies">Master of Arts in Philippine Studies (MAPhilS)</option>
          <option value="Master of Arts in Philosophy">Master of Arts in Philosophy (MAPhilo)</option>
          <option value="Master of Arts in Psychology">Master of Arts in Psychology (MAP)</option>
          <optgroup label="Major in">
              <option value="Clinical Psychology">Clinical Psychology</option>
              <option value="Industrial Psychology">Industrial Psychology</option>
          </optgroup>
          <option value="Master of Arts in Sociology">Master of Arts in Sociology (MASocio)</option>
          <option value="Master of Science in Biology">Master of Science in Biology (MSBio)</option>
          <option value="Master of Science in Civil Engineering">Master of Science in Civil Engineering (MSCE)</option>
          <optgroup label="Specializations">
              <option value="Structural Engineering">Structural Engineering</option>
              <option value="Transport Engineering">Transport Engineering</option>
              <option value="Geotechnical Engineering">Geotechnical Engineering</option>
              <option value="Water Resources Engineering">Water Resources Engineering</option>
          </optgroup>
          <option value="Master of Science in Computer Engineering">Master of Science in Computer Engineering (MSCpE)</option>
          <optgroup label="Specializations">
              <option value="Applied Security and Digital Forensics">Applied Security and Digital Forensics</option>
              <option value="Data Science and Engineering">Data Science and Engineering</option>
          </optgroup>
          <option value="Master of Science in Economics">Master of Science in Economics (MSEcon)</option>
          <option value="Master of Science in Electronics Engineering">Master of Science in Electronics Engineering (MSEcE)</option>
          <optgroup label="Specializations">
              <option value="Artificial Intelligence and Automation">Artificial Intelligence and Automation</option>
              <option value="Telecommunications">Telecommunications</option>
          </optgroup>
          <option value="Master of Science in Industrial Engineering">Master of Science in Industrial Engineering (MSIE)</option>
          <option value="Master of Science in Information Technology">Master of Science in Information Technology (MSIT)</option>
          <optgroup label="Specializations">
              <option value="Data Analytics">Data Analytics</option>
              <option value="Information Security">Information Security</option>
          </optgroup>
          <option value="Master of Science in International Tourism and Hospitality Management">Master of Science in International Tourism and Hospitality Management (MSITHM)</option>
          <optgroup label="Specializations">
              <option value="Hotel Operations">Hotel Operations</option>
              <option value="Travel and Tourism Operations">Travel and Tourism Operations</option>
          </optgroup>
          <option value="Master of Science in Mathematics">Master of Science in Mathematics (MSMath)</option>
          <option value="Master of Science in Mechanical Engineering">Master of Science in Mechanical Engineering (MSME)</option>
          <option value="Master of Science in Nutrition and Dietetics">Master of Science in Nutrition and Dietetics (MSND)</option>
          <option value="Professional Science Masters in Railway Engineering Management">Professional Science Masters in Railway Engineering Management (PSMREM)</option>
      </optgroup>






      <optgroup label="Open University System">
        <option value="Doctor in Business Administration">Doctor in Business Administration (DBA)</option>
        <option value="Doctor in Engineering Management">Doctor in Engineering Management (D.Eng)</option>
        <option value="Doctor of Philosophy in Education Management">Doctor of Philosophy in Education Management (PhDEM)</option>
        <option value="Doctor in Public Administration">Doctor in Public Administration (DPA)</option>
        <option value="Master in Communication">Master in Communication (MC)</option>
        <option value="Master in Business Administration">Master in Business Administration (MBA)</option>
        <option value="Master of Arts in Education Management">Master of Arts in Education Management (MAEM)</option>
        <option value="Master in Information Technology">Master in Information Technology (MIT)</option>
        <option value="Master in Public Administration">Master in Public Administration (MPA)</option>
        <option value="Master of Science in Construction Management">Master of Science in Construction Management (MSCM)</option>
        <option value="Post Baccalaureate Diploma in Information Technology">Post Baccalaureate Diploma in Information Technology (PBDIT)</option>
        <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
        <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BABR)</option>
        <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBAHRM)</option>
        <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBAMM)</option>
        <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration (BSOA)</option>
        <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management (BSTM)</option>
        <option value="Bachelor of Public Administration">Bachelor of Public Administration (BPA)</option>
    </optgroup>





    <optgroup label="College of Accountancy and Finance (CAF)">
      <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
      <option value="Bachelor of Science in Business Administration Major in Financial Management">Bachelor of Science in Business Administration Major in Financial Management (formerly Bachelor of Science in Banking and Finance) (BSBAFM)</option>
      <option value="Bachelor of Science in Management Accounting">Bachelor of Science in Management Accounting (BSMA)</option>
  </optgroup>



  <optgroup label="College of Architecture, Design and the Built Environment (CADBE)">
    <option value="Bachelor of Science in Architecture">Bachelor of Science in Architecture (BS-ARCH)</option>
    <option value="Bachelor of Science in Interior Design">Bachelor of Science in Interior Design (BSID)</option>
    <option value="Bachelor of Science in Environmental Planning">Bachelor of Science in Environmental Planning (BSEP)</option>
</optgroup>



<optgroup label="College of Arts and Letters (CAL)">
  <option value="Bachelor of Arts in English Language Studies">Bachelor of Arts in English Language Studies (formerly Bachelor of Arts in English) (ABELS)</option>
  <option value="Bachelor of Arts in Filipinology">Bachelor of Arts in Filipinology (ABF)</option>
  <option value="Bachelor of Arts in Literary and Cultural Studies">Bachelor of Arts in Literary and Cultural Studies (ABLCS)</option>
  <option value="Bachelor of Arts in Philosophy">Bachelor of Arts in Philosophy (AB-PHILO)</option>
  <option value="Bachelor of Performing Arts major in Theater Arts">Bachelor of Performing Arts major in Theater Arts (formerly BA Theater Arts) (BPEA)</option>
</optgroup>



<optgroup label="College of Business Administration (CBA)">
  <option value="Doctor in Business Administration">Doctor in Business Administration (DBA)</option>
  <option value="Master in Business Administration">Master in Business Administration (MBA)</option>
  <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (formerly Bachelor of Science in Human Resource Development Management) (BSBAHRM)</option>
  <option value="Bachelor of Science in Business Administration major in Marketing Managemen">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
  <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
  <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration (BSOA)</option>
</optgroup>




<optgroup label="College of Communication (COC)">
  <option value="Bachelor in Advertising and Public Relations">Bachelor in Advertising and Public Relations (BADPR)</option>
  <option value="Bachelor of Arts in Broadcasting">Bachelor of Arts in Broadcasting (BA Broadcasting)</option>
  <option value="Bachelor of Arts in Communication Research">Bachelor of Arts in Communication Research (BACR)</option>
  <option value="Bachelor of Arts in Journalism">Bachelor of Arts in Journalism (BAJ)</option>
</optgroup>



<optgroup label="College of Computer and Information Sciences (CCIS)">
  <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science (BSCS)</option>
  <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
</optgroup>



<optgroup label="College of Education (COED)">
  <option value="Doctor of Philosophy in Education Management">Doctor of Philosophy in Education Management (PhDEM)</option>
  <option value="Master of Arts in Education Management">Master of Arts in Education Management (MAEM) with Specialization in:
      <option value="Educational Leadership">Educational Leadership</option>
      <option value="Instructional Leadership">Instructional Leadership</option>
  </option>
  <option value="Master in Business Education">Master in Business Education (MBE)</option>
  <option value="Master in Library and Information Science">Master in Library and Information Science (MLIS)</option>
  <option value="Master of Arts in English Language Teaching">Master of Arts in English Language Teaching (MAELT)</option>
  <option value="Master of Arts in Education major in Mathematics Education">Master of Arts in Education major in Mathematics Education (MAEd-ME)</option>
  <option value="Master of Arts in Physical Education and Sports">Master of Arts in Physical Education and Sports (MAPES)</option>
  <option value="Master of Arts in Education major in Teaching in the Challenged Areas">Master of Arts in Education major in Teaching in the Challenged Areas (MAED-TCA)</option>
  <option value="Post-Baccalaureate Diploma in Education">Post-Baccalaureate Diploma in Education (PBDE)</option>
  <option value="Bachelor of Technology and Livelihood Education">Bachelor of Technology and Livelihood Education (BTLEd) major in:
      <option value="Home Economics">Home Economics</option>
      <option value="Industrial Arts">Industrial Arts</option>
      <option value="Information and Communication Technology">Information and Communication Technology</option>
  </option>
  <option value="Bachelor of Library and Information Science">Bachelor of Library and Information Science (BLIS)</option>
  <option value="Bachelor of Secondary Education">Bachelor of Secondary Education (BSEd) major in:
      <option value="English">English</option>
      <option value="Mathematics">Mathematics</option>
      <option value="Science">Science</option>
      <option value="Filipino">Filipino</option>
      <option value="Social Studies">Social Studies</option>
  </option>
  <option value="Bachelor of Elementary Education">Bachelor of Elementary Education (BEEd)</option>
  <option value="Bachelor of Early Childhood Education">Bachelor of Early Childhood Education (BECEd)</option>
</optgroup>




<optgroup label="College of Engineering (CE)">
  <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering (BSCE)</option>
  <option value="Bachelor of Science in Computer Engineering">Bachelor of Science in Computer Engineering (BSCpE)</option>
  <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering (BSEE)</option>
  <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BSECE)</option>
  <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial Engineering (BSIE)</option>
  <option value="Bachelor of Science in Mechanical Engineering">Bachelor of Science in Mechanical Engineering (BSME)</option>
  <option value="Bachelor of Science in Railway Engineering">Bachelor of Science in Railway Engineering (formerly Bachelor of Science in Railway Engineering and Management) (BSRE)</option>
</optgroup>




<optgroup label="College of Human Kinetics (CHK)">
  <option value="Bachelor of Physical Education">Bachelor of Physical Education (BPE)</option>
  <option value="Bachelor of Science in Exercises and Sports">Bachelor of Science in Exercises and Sports (BSESS)</option>
</optgroup>



<optgroup label="College of Law (CL)">
  <option value="Juris Doctor">Juris Doctor (JD)</option>
</optgroup>



<optgroup label="College of Political Science and Public Administration (CPSPA)">
  <option value="Doctor in Public Administration">Doctor in Public Administration (DPA)</option>
  <option value="Master in Public Administration">Master in Public Administration (MPA)</option>
  <option value="Bachelor of Arts in Political Science">Bachelor of Arts in Political Science (BAPS)</option>
  <option value="Bachelor of Arts in Political Science">Bachelor of Arts in Political Science (BAPE)</option>
  <option value="Bachelor of Arts in International Studies">Bachelor of Arts in International Studies (BAIS)</option>
  <option value="Bachelor of Public Administration">Bachelor of Public Administration (BPA)</option>
</optgroup>



<optgroup label="College of Social Sciences and Development (CSSD)">
  <option value="Bachelor of Arts in History">Bachelor of Arts in History (BAH)</option>
  <option value="Bachelor of Arts in Sociology">Bachelor of Arts in Sociology (formerly Bachelor of Science in Sociology) (BAS)</option>
  <option value="Bachelor of Science in Cooperatives">Bachelor of Science in Cooperatives (formerly Bachelor in Cooperatives) (BSC)</option>
  <option value="Bachelor of Science in Economics">Bachelor of Science in Economics (BSE)</option>
  <option value="Bachelor of Science in Psychology">Bachelor of Science in Psychology (BSPSY)</option>
</optgroup>



<optgroup label="College of Science (CS)">
  <option value="Bachelor of Science Food Technology">Bachelor of Science Food Technology (BSFT)</option>
  <option value="Bachelor of Science in Applied Mathematics">Bachelor of Science in Applied Mathematics (BSAPMATH)</option>
  <option value="Bachelor of Science in Biology">Bachelor of Science in Biology (BSBIO)</option>
  <option value="Bachelor of Science in Chemistry">Bachelor of Science in Chemistry (BSCHEM)</option>
  <option value="Bachelor of Science in Mathematics">Bachelor of Science in Mathematics (BSMATH)</option>
  <option value="Bachelor of Science in Nutrition and Dietetics">Bachelor of Science in Nutrition and Dietetics (BSND)</option>
  <option value="Bachelor of Science in Physics">Bachelor of Science in Physics (BSPHY)</option>
  <option value="Bachelor of Science in Statistics">Bachelor of Science in Statistics (formerly Bachelor in Applied Statistics) (BSSTAT)</option>
</optgroup>



<optgroup label="College of Tourism, Hospitality and Transportation Management (CTHTM)">
  <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
  <option value="Bachelor of Science in Tourism Management">Bachelor of Science in Tourism Management (BSTM)</option>
  <option value="Bachelor of Science in Transportation Management">Bachelor of Science in Transportation Management (formerly Bachelor in Transportation Management) (BSTRM)</option>
</optgroup>



<optgroup label="Institute of Technology">
  <option value="Diploma in Computer Engineering Technology">Diploma in Computer Engineering Technology (DCET)</option>
  <option value="Diploma in Electrical Engineering Technology">Diploma in Electrical Engineering Technology (DEET)</option>
  <option value="Diploma in Electronics Engineering Technology">Diploma in Electronics Engineering Technology (DECET)</option>
  <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
  <option value="Diploma in Mechanical Engineering Technology">Diploma in Mechanical Engineering Technology (DMET)</option>
  <option value="Diploma in Office Management">Diploma in Office Management (DOMT)</option>
</optgroup>




<optgroup label="Senior High School">
  <option value="Academic Track - General Academic Strand">Academic Track - General Academic Strand (GAS)</option>
  <option value="Science, Technology, Engineering and Mathematics">Science, Technology, Engineering and Mathematics (STEM) Strand</option>
  <option value="Accountancy, Business and Management">Accountancy, Business and Management (ABM) Strand</option>
  <option value="Humanities and Social Sciences">Humanities and Social Sciences (HumSS) Strand</option>
  <option value="Arts and Design Track">Arts and Design Track</option>
  <option value="Technical, Vocational and Livelihood Track">Technical, Vocational and Livelihood Track - Tourism, Home Economics</option>
  <option value="Technical, Vocational and Livelihood Track - Industrial Arts">Technical, Vocational and Livelihood Track - Industrial Arts (Automotive, Electronics, Electrical)</option>
  <option value="Technical, Vocational and Livelihood Track - Information and Communications Technology">Technical, Vocational and Livelihood Track - Information and Communications Technology</option>
</optgroup>
        <optgroup label="Taguig City (Branch)">
            
            <option value="Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)">
                Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)
            </option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)">
                Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)
            </option>
            <option value="Bachelor of Science in Electronics Engineering (BS-ECE)">
                Bachelor of Science in Electronics Engineering (BS-ECE)
            </option>
            <option value="Bachelor of Science in Information Technology (BSIT)">
                Bachelor of Science in Information Technology (BSIT)
            </option>
            <option value="Bachelor of Science in Mechanical Engineering (BSME)">
                Bachelor of Science in Mechanical Engineering (BSME)
            </option>
            <option value="Bachelor of Science in Office Administration major in Legal Transcription (BSOALT)">
                Bachelor of Science in Office Administration major in Legal Transcription (BSOALT)
            </option>
            <option value="Bachelor of Secondary Education major in English (BSEDEN)">
                Bachelor of Secondary Education major in English (BSEDEN)
            </option>
            <option value="Bachelor of Secondary Education major in Mathematics (BSEDMT)">
                Bachelor of Secondary Education major in Mathematics (BSEDMT)
            </option>
            <option value="Diploma in Information Communication Technology (DICT)">
                Diploma in Information Communication Technology (DICT)
            </option>
            <option value="Diploma in Mechanical Engineering Technology (DMET)">
                Diploma in Mechanical Engineering Technology (DMET)
            </option>
            <option value="Diploma in Office Management Technology- Legal Office Management (DOMTLOM)">
                Diploma in Office Management Technology- Legal Office Management (DOMTLOM)
            </option>
        </optgroup>

        <optgroup label="San Juan City (Branch)">
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Business Administration Major in Financial Management ">Bachelor of Science in Business Administration Major in Financial Management (BSBAFM )</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BBSEDMT)</option>
        </optgroup>





 <optgroup label="Parañaque City (Campus)">
            <option value="Bachelor of Science in Computer Engineering">Bachelor of Science in Computer Engineering (BSCpE)</option>
            <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
            <option value="Bachelor of Science in Information Technolog">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration (BSOA)</option>
            <option value="Diploma in Office Management Technology Legal Office Management">Diploma in Office Management Technology Legal Office Management (DOMTLOM)</option>
        </optgroup>



<optgroup label="Bataan (Branch)">
            <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial Engineering (BSIE)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Diploma in Computer Engineering Technology">Diploma in Computer Engineering Technology (DCET)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
            <option value="Diploma in Office Management Technology Legal Office Management">Diploma in Office Management Technology Legal Office Management (DOMTLOM)</option>
            <option value="Post Baccalaureate in Teacher Education">Post Baccalaureate in Teacher Education (PBTE)</option>
        </optgroup>



<optgroup label="Sta. Maria, Bulacan (Campus)">
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Computer Engineering">Bachelor of Science in Computer Engineering (BSCpE)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BSEDMT)</option>
            <option value="Diploma in Office Management Technology- Legal Office Management">Diploma in Office Management Technology- Legal Office Management (DOMTLOM)</option>
        </optgroup>




<optgroup label="Pulilan, Bulacan (Campus)">
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Public Administration major in Public Financial Management">Bachelor of Public Administration major in Public Financial Management (BPAPFM)</option>
        </optgroup>



<optgroup label="Cabiao, Nueva Ecija (Campus)">
            <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
        </optgroup>



<optgroup label="Lopez, Quezon (Branch)">
            <option value="Bachelor of Public Administration">Bachelor of Public Administration (BPA)</option>
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Agricultural Business Management">Bachelor of Science in Agricultural Business Management (BSAM)</option>
            <option value="Bachelor of Science in Architecture">Bachelor of Science in Architecture (BS-ARCHI)</option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
            <option value="Bachelor of Science in Civil Engineering">Bachelor of Science in Civil Engineering (BSCE)</option>
            <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering (BSEE)</option>
            <option value="Bachelor of Science in Hospitality Management">Bachelor of Science in Hospitality Management (BSHM)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration (BSOA)</option>
            <option value="Bachelor of Public Administration major in Public Financial Management">Bachelor of Public Administration major in Public Financial Management (BPAPFM)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BSEDMT)</option>
            <option value="Diploma in Electrical Engineering Technology">Diploma in Electrical Engineering Technology (DEET)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
            <option value="Diploma in Office Management Technology">Diploma in Office Management Technology (DOMT)</option>
        </optgroup>


 <optgroup label="Mulanay, Quezon (Branch)">
            <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
            <option value="Bachelor of Science in Agricultural Business Management">Bachelor of Science in Agricultural Business Management (BSAM)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration (BSOA)</option>
            <option value="Bachelor of Public Administration major in Public Financial Management">Bachelor of Public Administration major in Public Financial Management (BPAPFM)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
            <option value="Diploma in Office Management Medical Office Management">Diploma in Office Management Medical Office Management (DOMTMOM)</option>
        </optgroup>




<optgroup label="General Luna, Quezon (Mulanay Annex)">
            <option value="Bachelor of Public Administration">Bachelor of Public Administration (BPA)</option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
        </optgroup>




<optgroup label="Unisan, Quezon (Branch)">
            <option value="Masters in Educational Management">Masters in Educational Management (MEM, Open University System)</option>
            <option value="Masters in Public Administration">Masters in Public Administration (MPA, Open University System)</option>
            <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
            <option value="Diploma in Office Management Technology">Diploma in Office Management Technology (DOMT)</option>
        </optgroup>



 <optgroup label="Ragay, Camarines Sur (Branch)">
            <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
            <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)</option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Science in Office Administration">Bachelor of Science in Office Administration (BSOA)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
        </optgroup>




 <optgroup label="Sto. Tomas, Batangas (Branch)">
            <option value="Bachelor of Business Technology and Livelihood Education">Bachelor of Business Technology and Livelihood Education (BBTLE)</option>
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering (BSEE)</option>
            <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BS-ECE)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial Engineering (BSIE)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Public Administration major in Public Financial Management">Bachelor of Public Administration major in Public Financial Management (BPAPFM)</option>
            <option value="Bachelor of Science in Psychology">Bachelor of Science in Psychology (BSPSY)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
            <option value="Diploma in Office Management Technology- Legal Office Management">Diploma in Office Management Technology- Legal Office Management (DOMTLOM)</option>
        </optgroup>




 <optgroup label="Maragondon, Cavite (Branch)">
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Science in Electrical Engineering">Bachelor of Science in Electrical Engineering (BSEE)</option>
            <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BS-ECE)</option>
            <option value="Bachelor of Science in Entrepreneurship (Open University)">Bachelor of Science in Entrepreneurship (Open University) (BSENTREP)</option>
            <option value="Bachelor of Science in Mechanical Engineering">Bachelor of Science in Mechanical Engineering (BSME)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
            <option value="Diploma in Office Management Technology- Legal Office Management">Diploma in Office Management Technology- Legal Office Management (DOMTLOM)</option>
            <option value="Diploma in Office Management Technology- Medical Office Management">Diploma in Office Management Technology- Medical Office Management (DOMTMOM)</option>
            <option value="Post Baccalaureate in Teacher Education">Post Baccalaureate in Teacher Education (PBTE)</option>
        </optgroup>



 <optgroup label="Alfonso, Cavite (Maragondon Annex)">
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Mechanical Engineering">Bachelor of Science in Mechanical Engineering (BSME)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BSEDMT)</option>
        </optgroup>




<optgroup label="Bansud, Oriental Mindoro (Branch)">
            <option value="Master of Arts in Education Management">Master of Arts in Education Management (Open University)</option>
            <option value="Master in Public Administration">Master in Public Administration (Open University)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Public Administration major in Public Financial Management">Bachelor of Public Administration major in Public Financial Management (BPAPFM)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BSEDMT)</option>
        </optgroup>



<optgroup label="Sablayan, Occidental Mindoro (Branch)">
            <option value="Master in Educational Management">Master in Educational Management (MEM, Open University System)</option>
            <option value="Master in Public Administration">Master in Public Administration (MPA, Open University System)</option>
            <option value="Bachelor in Cooperatives">Bachelor in Cooperatives (BCOOP)</option>
            <option value="Bachelor in Secondary Education major in Mathematics">Bachelor in Secondary Education major in Mathematics (BSEDMT)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Associate Degree Associate in Tourism Management">Associate Degree Associate in Tourism Management (ATM)</option>
        </optgroup>



<optgroup label="Biñan, Laguna (Campus)">
            <option value="Bachelor in Elementary Education">Bachelor in Elementary Education (BEED)</option>
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)</option>
            <option value="Bachelor of Science in Computer Engineering">Bachelor of Science in Computer Engineering (BSCpE)</option>
            <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial Engineering (BSIE)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Social Studies">Bachelor of Secondary Education major in Social Studies (BSEDSS)</option>
            <option value="Diploma in Computer Engineering Technology">Diploma in Computer Engineering Technology (DCET)</option>
            <option value="Diploma in Information Communication Technology">Diploma in Information Communication Technology (DICT)</option>
        </optgroup>



 <optgroup label="San Pedro, Laguna (Campus)">
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)</option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BSEDMT)</option>
        </optgroup>



<optgroup label="Sta. Rosa, Laguna (Campus)">
            <option value="Bachelor of Business Technology and Livelihood Education">Bachelor of Business Technology and Livelihood Education (BBTLE)</option>
            <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy (BSA)</option>
            <option value="Bachelor of Science in Business Administration major in Human Resource Management">Bachelor of Science in Business Administration major in Human Resource Management (BSBA-HRM)</option>
            <option value="Bachelor of Science in Business Administration major in Marketing Management">Bachelor of Science in Business Administration major in Marketing Management (BSBA-MM)</option>
            <option value="Bachelor of Science in Electronics Engineering">Bachelor of Science in Electronics Engineering (BS-ECE)</option>
            <option value="Bachelor of Science in Industrial Engineering">Bachelor of Science in Industrial Engineering (BSIE)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
            <option value="Bachelor of Science in Psychology">Bachelor of Science in Psychology (BSPSY)</option>
            <option value="Bachelor of Secondary Education major in English">Bachelor of Secondary Education major in English (BSEDEN)</option>
            <option value="Bachelor of Secondary Education major in Filipino">Bachelor of Secondary Education major in Filipino (BSEDFL)</option>
            <option value="Bachelor of Secondary Education major in Mathematics">Bachelor of Secondary Education major in Mathematics (BSEDMT)</option>
        </optgroup>



 <optgroup label="Calauan, Laguna (Campus)">
            <option value="Bachelor of Business Technology and Livelihood Education major in Home Economics">Bachelor of Business Technology and Livelihood Education major in Home Economics (BBTLEDHE-CL)</option>
            <option value="Bachelor of Science in Entrepreneurship">Bachelor of Science in Entrepreneurship (BSENTREP-UN)</option>
            <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology (BSIT)</option>
        </optgroup>




      
        
    
    </select> 
</div>

<br />

 <div class="pass-field">
                <input type="name" name="email" placeholder="Email" required>
            </div>
            <br />
            <div class="pass-field">
                <input type="number" name="cpNum" placeholder="Phone Number" required>
            </div>
            <br />
            <div class="pass-field">
                <input type="password" name="password" placeholder="Create password" />
                <i class="fa-solid fa-eye"></i>
            </div>
            <div class="content">
                <p>Password must contains</p>
                <ul class="requirement-list">
                    <li>
                        <i class="fa-solid fa-circle"></i>
                        <span>At least 8 characters length</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle"></i>
                        <span>At least 1 number (0...9)</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle"></i>
                        <span>At least 1 lowercase letter (a...z)</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle"></i>
                        <span>At least 1 special symbol (!...$)</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle"></i>
                        <span>At least 1 uppercase letter (A...Z)</span>
                    </li>
                    <table style="width: 150%;">
                        <tr>
                            <td>
                                <a href="login.php" class="back-button">Go back</a>
                            </td>
                            <td>
                                <input type="submit" id="submitBtn" name="submit" value="Create Account" />
                            </td>
                        </tr>
                    </table>

                    <script>
                    function displayAlert() {
                        alert("Successfully created account!");
                    }
                    </script>
    </form>
    </ul>
    </div>
    </div>
    <div class="image-container">
        <img class="pic1" src="img/key.png" alt="" style="height: 40rem;">

    </div>
</body>

</html>
<script>
const passwordInput = document.querySelector(
    ".pass-field input[type='password']"
);
const eyeIcon = document.querySelector(".pass-field i");
const requirementList = document.querySelectorAll(".requirement-list li");

// An array of password requirements with corresponding
// regular expressions and index of the requirement list item
const requirements = [{
        regex: /.{8,}/,
        index: 0
    }, // Minimum of 8 characters
    {
        regex: /[0-9]/,
        index: 1
    }, // At least one number
    {
        regex: /[a-z]/,
        index: 2
    }, // At least one lowercase letter
    {
        regex: /[^A-Za-z0-9]/,
        index: 3
    }, // At least one special character
    {
        regex: /[A-Z]/,
        index: 4
    }, // At least one uppercase letter
];

passwordInput.addEventListener("keyup", (e) => {
    requirements.forEach((item) => {
        // Check if the password matches the requirement regex
        const isValid = item.regex.test(e.target.value);
        const requirementItem = requirementList[item.index];

        // Updating class and icon of requirement item if requirement matched or not
        if (isValid) {
            requirementItem.classList.add("valid");
            requirementItem.firstElementChild.className = "fa-solid fa-check";
        } else {
            requirementItem.classList.remove("valid");
            requirementItem.firstElementChild.className = "fa-solid fa-circle";
        }
    });
});

eyeIcon.addEventListener("click", () => {
    // Toggle the password input type between "password" and "text"
    passwordInput.type =
        passwordInput.type === "password" ? "text" : "password";

    // Update the eye icon class based on the password input type
    eyeIcon.className = `fa-solid fa-eye${
      passwordInput.type === "password" ? "" : "-slash"
    }`;
});

function updateSubmitButtonState() {
    const allValid = Array.from(requirementList).every((item) =>
        item.classList.contains("valid")
    );
    document.getElementById("submitBtn").disabled = !allValid;
}

passwordInput.addEventListener("keyup", (e) => {
    requirements.forEach((item) => {
        const isValid = item.regex.test(e.target.value);
        const requirementItem = requirementList[item.index];

        if (isValid) {
            requirementItem.classList.add("valid");
            requirementItem.firstElementChild.className = "fa-solid fa-check";
        } else {
            requirementItem.classList.remove("valid");
            requirementItem.firstElementChild.className = "fa-solid fa-circle";
        }
    });

    // Update the submit button state each time the password input changes
    updateSubmitButtonState();
});
</script>