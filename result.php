<?php 
include 'admin/db_connect.php'; 
?>
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
<style>
#portfolio .img-fluid {
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}

.vacancy-list {
    cursor: pointer;
}

#mainNav.navbar-scrolled {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    background-color: #FE7A36;
    color: white !important;
}

span.hightlight {
    background: yellow;
}

.pic1 {
    position: absolute;
    left: 45%;
    top: 25%;
    float: left;
    height: 50%;
    width: 50%;
}

.outer-headings {
    margin-top: 150px;
    width: 50%;
    font-size: 2rem;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    display: grid;
    justify-content: center;
    align-items: right;
    flex-direction: column;
    padding-bottom: 25%;
}

.second {
    padding-top: 100px;
    margin: 0;
    width: 100%;
}

.inner-headings {
    border: 1px solid;
    height: 50px;
    line-height: 50px;
    overflow: hidden;
}

.inner-headings span {
    position: relative;
    color: #FE7A36;
    animation: ani 10s ease infinite;
}

hr.divider {
    max-width: 100%;

    border-width: medium;
    border-color: orange;
}

@keyframes ani {

    0%,
    100% {
        top: 0;
    }

    10% {
        top: 0;
    }

    25% {
        top: -50px;
    }

    45% {
        top: -50px;
    }

    50% {
        top: -100px;
    }

    70% {
        top: -100px;
    }

    75% {
        top: -150px;
    }

    95% {
        top: -150px;
    }
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

@font-face {
    font-family: pop;
    src: url(./Fonts/Poppins-Medium.ttf);
}

.main {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: pop;
    flex-direction: column;
}

.head {
    text-align: center;
}

.head_1 {
    font-size: 80px;
    font-weight: 600;
    color: #333;
}

.head_1 span {
    color: #fe7a36;
}

.head_2 {
    font-size: 25px;
    font-weight: 600;
    color: #333;
    margin-top: 3px;
}

.ul-jv {
    display: flex;
    margin-top: 80px;
}

.ul-jv #jv-li {
    list-style: none;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.ul-jv #jv-li .icon {
    font-size: 35px;
    color: #fe7a36;
    margin: 0 60px;
}

.ul-jv #jv-li .text {
    font-size: px;
    font-weight: 600;
    color: #fe7a36;
}

/* Progress Div Css  */

.ul-jv #jv-li .progress1 {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(68, 68, 68, 0.781);
    margin: 14px 0;
    display: grid;
    place-items: center;
    color: #fff;
    position: relative;
    cursor: pointer;
}

.progress1::after {
    content: " ";
    position: absolute;
    width: 125px;
    height: 5px;
    background-color: rgba(68, 68, 68, 0.781);
    right: 30px;
}

.one::after {
    width: 0;
    height: 0;
}

.ul-jv #jv-li .progress1 .uil {
    display: none;
}

.ul-jv #jv-li .progress1 p {
    font-size: 13px;
}

/* Active Css  */

.ul-jv #jv-li .active {
    background-color: #ff4732;
    display: grid;
    place-items: center;
}

.ul-jv .active::after {
    background-color: #ff4732;
}

.ul-jv #jv-li .active p {
    display: none;
}

.ul-jv #jv-li .active .uil {
    font-size: 20px;
    display: flex;
}

/* Responsive Css  */

@media (max-width: 980px) {
    .ul-jv {
        flex-direction: column;
    }

    .ul-jv #jv-li {
        flex-direction: row;
    }

    .ul-jv #jv-li .progress1 {
        margin: 0 30px;
    }

    .progress1::after {
        width: 5px;
        height: 55px;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        z-index: -1;
    }

    .one::after {
        height: 0;
    }

    .ul-jv #jv-li .icon {
        margin: 15px 0;
    }
}

@media (max-width: 600px) {
    .head .head_1 {
        font-size: 24px;
    }

    .head .head_2 {
        font-size: 16px;
    }
}

.blur-effect {
    filter: blur(5px);
    /* Adjust the blur level as needed */
}

#popup {
    position: fixed;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 600px;
    padding: 50px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, .30);
    background: #fff;
    visibility: hidden;
    opacity: 0;
    transition: 0.5s;
}

#popup.active {
    top: 50%;
    visibility: visible;
    opacity: 1;
    transform: 0.5s;
}
</style>
<div class="second">
    <div class="outer-headings">
        <img class="pic1" src="img/kick.png" alt="">
        <h1>
            WELCOME TO KICK START

            <div class="inner-headings">
                <span>
                    CAREER GROWTH <br />
                    Dynamic Environment<br />
                    Collaborative Culture<br />
                    Inclusive Team<br />
                </span>
            </div>
        </h1>
    </div>

</div>
<div class="main">
    <div class="head">
        <p class="head_1">Find Your <span>Dream Job</span>Today</p>
        <p class="head_2">Let's Kick! in this few steps</p>
    </div>

    <ul class="ul-jv">
        <li id="jv-li">
            <i class="icon uil uil-sign-out-alt"></i>
            <div class="progress1 one">
                <p>1</p>
                <i class="uil uil-check"></i>
            </div>
            <p class="text">Create Account</p>
        </li>
        <li id="jv-li">
            <i class="icon uil uil-user-check"></i>
            <div class="progress1 two">
                <p>2</p>
                <i class="uil uil-check"></i>
            </div>
            <p class="text">Login</p>
        </li>
        <li id="jv-li">
            <i class="icon uil uil-search"></i>
            <div class="progress1 three">
                <p>3</p>
                <i class="uil uil-check"></i>
            </div>
            <p class="text">Search Job</p>
        </li>
        <li id="jv-li">
            <i class="icon uil  uil-clipboard-notes"></i>
            <div class="progress1 four">
                <p>4</p>
                <i class="uil uil-check"></i>
            </div>
            <p class="text">Fill Details</p>
        </li>
        <li id="jv-li">
            <i class="icon uil uil-file-check"></i>
            <div class="progress1 five">
                <p>5</p>
                <i class="uil uil-check"></i>
            </div>
            <p class="text">Application Status</p>
        </li>
    </ul>
</div>
<section id="findjob">
    <header class="masthead">
        <div class="container-fluid h-100" id="classBlurred">
            <div class="row h-100 align-items-center justify-content-center text-center">

                <div class="col-lg-8 align-self-end mb-4 page-title" style="height: 400px;">
                    <br>
                    <br>
                    <br>
                    <h2 class="text-white">Ready to Kick In?</h2>
                    <hr class="divider my-4" />
                    <div class="col-md-12 mb-2 text-left">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="text-center">Search</h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="filter">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
</header>
<section id="list">
    <div class="container mt-3 pt-2" id="classBlurred2">
        <h4 class="text-center">Vacancy List</h4>
        <hr class="divider">
        <?php
                $vacancy = $conn->query("SELECT * FROM vacancy order by date(date_created) desc ");
                while($row = $vacancy->fetch_assoc()):
                    $trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
                    unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
                    $desc = strtr(html_entity_decode($row['description']),$trans);
                    $desc=str_replace(array("<li>","</li>"), array("",","), $desc);
                ?>
        <div class="card vacancy-list" data-id="<?php echo $row['id'] ?>">
            <div class="card-body">
                <h3><b class="filter-txt"><?php echo $row['position'] ?></b></h3>
                <span><small>Needed: <?php echo $row['availability'] ?></small></span>
                <hr>
                <larger class="truncate filter-txt" style="letter-spacing: 0.05em; word-spacing: 0.25em;">
                    <?php echo strip_tags($desc) ?>
                </larger>
                <br>
                <hr class="divider" style="max-width: calc(100%); border-top: 5px solid orange;">

            </div>
        </div>
        <br>
        <?php endwhile; ?>
    </div>
</section>

<div id="popup">
    <h2> REGISTERED ACCOUNT NEEDED</h2>
    <p>Please LogIn First to search Jobs</p>
    <a href="#" onclick="toggle()">Close</a>
</div>



<script>
const one = document.querySelector(".one");
const two = document.querySelector(".two");
const three = document.querySelector(".three");
const four = document.querySelector(".four");
const five = document.querySelector(".five");

one.onclick = function() {
    one.classList.add("active");
    two.classList.remove("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
};

two.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.remove("active");
    four.classList.remove("active");
    five.classList.remove("active");
};
three.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.remove("active");
    five.classList.remove("active");
};
four.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.add("active");
    five.classList.remove("active");
};
five.onclick = function() {
    one.classList.add("active");
    two.classList.add("active");
    three.classList.add("active");
    four.classList.add("active");
    five.classList.add("active");
};


$('.card.vacancy-list').click(function() {
    location.href = "index1.php?page=view_vacancy&id=" + $(this).attr('data-id')
})
$('#filter').keyup(function(e) {
    var filter = $(this).val()

    $('.card.vacancy-list .filter-txt').each(function() {
        var txto = $(this).html();
        txt = txto
        if ((txt.toLowerCase()).includes((filter.toLowerCase())) == true) {
            $(this).closest('.card').toggle(true)
        } else {
            $(this).closest('.card').toggle(false)

        }
    })
})
</script>