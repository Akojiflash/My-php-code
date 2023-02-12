<?php
//index.php
include './php/index_func.php';
session_start();


// Check if the form was submitted
if (isset($_POST['signin'])) {
    // Call the detail_check() function and store the result
    $login_success = detail_check($_POST['email'], $_POST['password']);

    // If the login was successful, redirect to the account page
    if ($login_success) {
        header("location: ./account.php");
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Sign in</title>
</head>

<body>
<div>

    <form action="index.php" method="post">
        <h3 class="heading">My Practice Login Page</h3>

        <label for="email" id="email">Email</label><br>
        <input type='email' name='email' class="input-field">

<!--        <input type='email' name='email'>-->
        <label for="password">Password</label><br>
        <input type="password" name="password">
        <input type="submit" name="signin" value="Sign in">
        <a href="signup.php"><input type="button" value="Sign up"></a>
        <div class="condition" style = " font-size: 12px">
            <?php
            global $login_success;
            if (!$login_success && isset($_POST['signin'])) {
                echo '<p>Wrong email or password </p>';
            } ?>
        </div>

    </form>

</div>


</body>
</html>