<?php 
include 'admin/db_connect.php';

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $companyName = $_POST['companyName'];
    $city = $_POST['city'];
    $nature = $_POST['nature'];
    $cpNum = $_POST['cpNum'];

    // Prepare the SQL INSERT statement with the course included
    $sql = "INSERT INTO `company`(`email`,`password`,`companyName`,`city`,`nature` ,`cpNum`)
            VALUES ('$email','$password','$companyName','$city','$nature','$cpNum')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn); // Use $conn instead of $con
    }

    // Redirect to login page after insertion
    header("Location: companylogin.php");
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
        color: #999;
        height: 100%;
        outline: none;
        padding: 8px 17px;
        /* Adjust padding */
        font-size: 1.3rem;
        border-radius: 5px;
        border: 1px solid #999;
        margin-bottom: 10px;
        /* Add margin bottom to create space */
    }

    .pass-field select:focus {
        padding: 8px 16px;
        /* Adjust padding */
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
            <h1>Company Sign UP</h1>
            <br />
            <div class="pass-field">
                <input type="text" name="companyName" placeholder="Company Name" required>
            </div>
            <br />

            <div class="pass-field">
                <input type="text" name="email" placeholder="Email" required>
            </div>
            <br />

            <div class="pass-field">
                <select id="" name="city" style="">
                    <option value="">City</option>
                    <option value="Antipolo">Antipolo</option>
                    <option value="Bacolod">Bacolod</option>
                    <option value="Bacoor">Bacoor</option>
                    <option value="Baguio">Baguio</option>
                    <option value="Butuan">Butuan</option>
                    <option value="Cagayan de Oro">Cagayan de Oro</option>
                    <option value="Caloocan">Caloocan</option>
                    <option value="Cebu City">Cebu City</option>
                    <option value="Dasmarinas">Dasmarinas</option>
                    <option value="Davao City">Davao City</option>
                    <option value="General Santos">General Santos</option>
                    <option value="Iligan">Iligan</option>
                    <option value="Iloilo City">Iloilo City</option>
                    <option value="Imus">Imus</option>
                    <option value="Lapu-Lapu">Lapu-Lapu</option>
                    <option value="Las Piñas">Las Piñas</option>
                    <option value="Lipa">Lipa</option>
                    <option value="Mabalacat">Mabalacat</option>
                    <option value="Makati">Makati</option>
                    <option value="Mandaluyong">Mandaluyong</option>
                    <option value="Mandaue">Mandaue</option>
                    <option value="Manila">Manila</option>
                    <option value="Marikina">Marikina</option>
                    <option value="Muntinlupa">Muntinlupa</option>
                    <option value="Olongapo">Olongapo</option>
                    <option value="Parañaque">Parañaque</option>
                    <option value="Pasay">Pasay</option>
                    <option value="Pasig">Pasig</option>
                    <option value="Puerto Princesa">Puerto Princesa</option>
                    <option value="Quezon City">Quezon City</option>
                    <option value="San Fernando">San Fernando</option>
                    <option value="San Jose del Monte">San Jose del Monte</option>
                    <option value="Tacloban">Tacloban</option>
                    <option value="Taguig">Taguig</option>
                    <option value="Tarlac City">Tarlac City</option>
                    <option value="Valenzuela">Valenzuela</option>
                    <option value="Zamboanga City">Zamboanga City</option>
                </select>
            </div>
            <br />



            <div class="pass-field">
                <select id="" name="nature" style="">
                    <option value="">Business type:</option>
                    <option value="Information Technology (IT)">Information Technology (IT)</option>
                    <option value="Banking and Financial Services">Banking and Financial Services</option>
                    <option value="Recruitment and Human Resources">Recruitment and Human Resources</option>
                    <option value="Merchandising/Retail">Merchandising/Retail</option>
                    <option value="Healthcare Services">Healthcare Services</option>
                    <option value="Real Estate">Real Estate</option>
                    <option value="Consulting">Consulting</option>
                    <option value="Manufacturing">Manufacturing</option>
                    <option value="Hospitality">Hospitality</option>
                    <option value="Transportation and Logistics">Transportation and Logistics</option>
                    <option value="Marketing and Advertising">Marketing and Advertising</option>
                    <option value="Education and Training">Education and Training</option>
                    <option value="Legal Services">Legal Services</option>
                    <option value="Construction and Engineering">Construction and Engineering</option>
                    <option value="Entertainment and Media">Entertainment and Media</option>
                    <option value="Food and Beverage">Food and Beverage</option>
                    <option value="Automotive">Automotive</option>
                    <option value="Energy and Utilities">Energy and Utilities</option>
                    <option value="Telecommunications">Telecommunications</option>
                    <option value="Insurance">Insurance</option>
                </select>

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
                                <a href="companyLogin.php" class="back-button">Go back</a>
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
        <img class="pic1" src="img/office.png" alt="" style="height: 40rem;">

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