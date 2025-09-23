<?php
require_once '../inc/conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/botstrab/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/flex-slider.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="../assets/css/register.css">


</head>

<body>

    <form method="POST" action="handleAdmin/handleRegister.php" enctype="multipart/form-data">
        <div class="container w-25">
            <img class="imageLogin" src="../assets/images/Blog.jpg" alt="">

            <?php
            require_once '../inc/error.php';
            ?>
            <h1 class="h1 text-center" data-translate="signup">Sign Up</h1>
            <hr>

            <label for="name"><b data-translate="name">Name</b></label>
            <input type="text" placeholder="Enter Name" name="name">

            <label for="email"><b data-translate="email">Email</b></label>
            <input type="email" placeholder="Enter Email" name="email">

            <label for="phone"><b data-translate="phone">Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone">

            <label for="psw"><b data-translate="password">Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw">

            <label for="psw-repeat"><b data-translate="repeat-password">Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat">


            <div class="clearfix ">
                <button type="submit" name="submit" class="signupbtn" data-translate="signup">Sign Up</button>
            </div>
            <div class="d-flex align-items-center">
                <p class="m-0" data-translate="already-have-an-account"> Already have an account? </p>
                <a class="mx-2" href="../login.php" data-translate="login">Log in</a>
            </div>
        </div>
    </form>
    <footer>
        <div class="footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner-content" data-translate="footer">
                        All rights reserved to Ammar Company 2025
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/botstrab/js/bootstrap.bundle.min.js"></script>


    <!-- Additional Scripts -->
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>
    <script src="../assets/js/slick.js"></script>
    <script src="../assets/js/isotope.js"></script>
    <script src="../assets/js/accordions.js"></script>
<script>let language = localStorage.getItem('language') || 'en';

function loadLanguage() {
    fetch(`../assets/lang/${language}.json`)
        .then(response => response.json())
        .then(data => {
            document.querySelectorAll('[data-translate]').forEach(element => {
                const key = element.getAttribute('data-translate');
                if (data[key]) {
                    element.innerText = data[key];
                }
            });
            document.getElementById('language-switch').innerText = data.language_switch;
        });
}
function switchLanguage() {
    language = (language === 'en') ? 'ar' : 'en';
    localStorage.setItem('language', language);
    loadLanguage();
}
loadLanguage();</script>

</body>

</html>