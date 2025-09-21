<?php
require_once 'inc/conn.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/botstrab/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/login.css">


</head>

<body>
<div class="login-container">
    <form method="POST" action="handle/handleLogin.php" enctype="multipart/form-data">
        <div class="container w-25">
            <img class="imageLogin" src="assets/images/Blog.jpg" alt="">
            <?php
            require_once 'inc/error.php';
            require_once 'inc/success.php';
            ?>
            <h1 class="h1 text-center">Login</h1>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email">

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw">

            <div class="clearfix ">
                <button type="submit" name="submit" class="signupbtn ">Login</button>
            </div>
                        <div class="d-flex align-items-center">
                <p class="m-0"> you dont have an account? </p>
            <a class="mx-2" href="admin/register.php">Create a new account</a>
            </div>
        </div>
    </form>
    </div>

<?php
    require_once 'inc/footer.php';
?>
</body>

</html>