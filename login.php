<?php
session_start();
include 'admin/db_connect.php'; // Include database connection file

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM student WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['UserLogin'] = $row['email'];
        $_SESSION['UserFirstName'] = $row['firstName']; // Storing firstname in session
        $_SESSION['UserLastName'] = $row['lastName'];
        header("Location: index1.php");
        exit;
    } else {
        echo "<div id='popupMessage' class='message warning'><span>No account found. <br>Please Try Again and ensure the information is correct.
        </span><button onclick='closePopup()'>Close</button></div>";
    }
}

include('header.php'); // Include header file
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Student Login</title>
    <style>
    header.masthead {
        background: url(admin/assets/img/1705742880_papers-laptop-office-table_23-2147772284.jpg);
        background-repeat: no-repeat;
        background-size: cover;
    }

    #mainNav .navbar-nav .nav-item .nav-link {
        color: orange;
        padding: 0 1rem;
    }



    .login-container {
        margin: 0 auto;
        width: 40%;
        margin-top: 20vh;
        background-color: white;
        border: 1px solid grey;
        border-radius: 10px;
        padding: 2rem;
        box-shadow: 5px 6px 10px black;
    }

    .login-container button {
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

    .login-container button:hover {
        background-color: #e67348;
        /* Darker shade of orange for hover effect */
        transform: scale(1.05);
    }

    .form-element label {
        text-align: left;
        padding-left: 30px;
        display: block;
        font-size: 22px;
        margin-top: 1rem;
    }

    .form-element input[type="text"],
    .form-element input[type="password"] {
        margin-top: .5rem;
        font-size: 22px;
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 10px;
        color: #888888;
    }

    .blurry-image {
        filter: blur(3px);
        background-position: center;
        background-size: cover;
        position: absolute;
        z-index: -1;
        width: 100%;
        height: 90%;
        top: 50;

    }

    .message.warning {
        position: fixed;
        /* Or absolute, depending on requirement */
        width: 40%;
        height: 50%;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 100;
        background-color: white;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .message.warning span {
        font-size: 2rem;
        margin-bottom: 20px;
        margin-top: 100px;
        text-align: center;
    }

    .message.warning button {
        border: none;
        outline: none;
        cursor: pointer;
        padding: 5px 10px;
        background-color: #f44336;
        /* Button color, adjust as needed */
        color: white;
        border-radius: 5px;
    }
    </style>
</head>

<body style="overflow: hidden;">
    <!-- Add your HTML content here -->
    <div class="blurry-image">
        <img class="blurry-image" src="img/login.png" alt="">
    </div>
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

    <div id="form-login" class="login-container">
        <h1>Student Login</h1>
        <form action="" method="post">
            <div class="form-element">
                <label>Email:</label>
                <input type="text" name="email" placeholder="" required>
            </div>
            <div class="form-element">
                <label>Password:</label>
                <input type="password" name="password" placeholder="" required>
            </div>
            <br>
            <a href="create.php"><img class="pic1" src="img/add.png" alt="" style="height: 2rem;">Create Account</a></p>


            <button type="submit" name="login"> Login</button>
        </form>
    </div>

    <?php include('footer.php'); // Include footer file ?>
</body>

</html>

<script>
function closePopup() {
    document.getElementById('popupMessage').style.display = 'none';
}
</script>
