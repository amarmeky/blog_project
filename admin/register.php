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

    <link rel="stylesheet" href="../assets/css/register.css">


</head>

<body>

    <form method="POST" action="handleAdmin/handleRegister.php" enctype="multipart/form-data">
        <div class="container w-25">
            <img class="imageLogin" src="../assets/images/Blog.jpg" alt="">

            <?php
            require_once '../inc/error.php';
            ?>
            <h1 class="h1 text-center">Sign Up</h1>
            <hr>

            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter Name" name="name">

            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email">

            <label for="phone"><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone">

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw">

            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat">


            <div class="clearfix ">
                <button type="submit" name="submit" class="signupbtn ">Sign Up</button>
            </div>
                        <div class="d-flex align-items-center">
                <p class="m-0"> Already have an account? </p>
            <a class="mx-2" href="../login.php">Log in</a>
            </div>
        </div>
    </form>
<?php
    require_once '../inc/footer.php';
?>

</body>

</html>