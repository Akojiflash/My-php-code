<?php
include './php/account_func.php';
session_start();

if (!$_SESSION['email'] && !$_SESSION['password']) {

    echo "empty";
}
$conditon = null;
 $id = query($_SESSION['email'], $_SESSION['password'])[0];

if (isset($_POST['update']) && detail_update($_POST['nemail'],
        $_POST['npassword'], query($_SESSION['email'], $_SESSION['password'])[0]) == true) {
    detail_update($_POST['nemail'],
        $_POST['npassword'], $id );
    $_SESSION['email'] = $_POST['nemail'];
    $_SESSION['password'] = $_POST['npassword'];
    $conditon = true;
} elseif (isset($_POST['update']) && detail_update($_POST['nemail'],
        $_POST['npassword'], query($_SESSION['email'], $_SESSION['password'])[0]) == false) {
    $conditon = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="./css/account.css">

</head>
<body>
<div class="card-container">
    <div class="card">


        <div class="name">
            <h4>Name:</h4>
            <hr noshade="">
            <p><?php echo query($_SESSION['email'], $_SESSION['password'])[1] . " " .
                    query($_SESSION['email'], $_SESSION['password'])[2]; ?> </p>
        </div>
        <div class="c-email">
            <h4>Current email:</h4>
            <hr noshade="">
            <p><?php echo query($_SESSION['email'], $_SESSION['password'])[3]; ?></p>

        </div>
        <div class="c-password">
            <h4>Current password:</h4>
            <hr noshade="">
            <p><?php echo query($_SESSION['email'], $_SESSION['password'])[4]; ?></p>

        </div>
        <div class="c-password" style="padding-top: 15px">
            <a href="index.php">Click here to sign in again</a>
        </div>
        <form action="" class="delete_bt">
            <input type="submit" name="delete" value="Delete" class="delete">
        </form>

    </div>
    <form class="form" action="account.php" method="post">
        <h3>Update Data</h3>

        <label for="email" id="email">Email</label><br>
        <label>
            <input type="email" name="nemail" required>
        </label>
        <label for="password" id="email">Password</label><br>

        <label>
            <input type="password" name="npassword" class="input-field" required>
        </label>
        <input type="submit" name="update" value="Update" class="update_button">
        <p style="font-size: 12px; color: red;">
            <?php

            if (!$conditon && (isset($_POST['update']))) {
                echo "password length must be 8 characters or more";
            }
            ?>

        </p>


    </form>

</div>

</body>
</html>