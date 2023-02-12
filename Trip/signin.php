<?php
session_start();

include './php functions/db.php';
include './php functions/signin_func.php';
global $verify;
if (isset($_POST['signin'])){
    signin_ver($_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip Sign in</title>
</head>
<link rel="stylesheet" href="./css/signin.css">

<body>
<div>
    <img src="./svg/logo.svg" alt="logo">


    <div class="grand_parent">
        <div id="heading">
            <h2 class="heading">Sign in</h2>

        </div>




        <div class="container">
            <form action="signin.php" method="post">
                <span class="email">
                    <label class="label_email" for="email">Email</label>
                    <input type="email" name="email" required>
                </span>

                <div class="password">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>

                </div>

                <p> <?php if (!isset($verify) && isset($_POST['signin']) ){
                    echo 'wrong password or email';

                    }elseif (isset($verify) && isset($_POST['signin'])){
                        header('location: ./account.php');
                       $_SESSION['email'] = $_POST['email'];
                        $_SESSION['password'] = $_POST['password'];
                    }?></p>
                <div class="signup">
                    <input   type="submit" name="signin" value="Sign in">
                </div>


                <a href="./signup.php"><input type="button" value="Sign up"></a>

            </form>

        </div>






    </div>
</div>




</body>
</html>
