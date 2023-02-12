<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include './php functions/account_func.php ';
include './php functions/db.php';
global $connection;
$verification = null;
$data_check =  null;
$details = null;
$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);
$account = false;
while($assoc = mysqli_fetch_assoc($result)){
    if($assoc['email'] == $_SESSION['email'] && $assoc['password'] == $_SESSION['password']){
        $details = account_details($_SESSION['email'], $_SESSION['password']);
        $_POST['fLname'] =  $details['firstName'] . ' '. $lastName =$details['lastName'];
        $account=true;
        break;
    }
}

if($account==false){
        header("location: ./signin.php");
    }
if(isset($_POST['delete'])){
    delete_account($_SESSION['email'], $_SESSION['password']);
    header("location: ./signin.php");
}
if(isset($_POST['update'])){
    $data_check= update_users($_POST['email'], $_POST['password'],$_POST['cpassword'] );
    if($verification == true){
        $details = account_details($_POST['email'], $_POST['password']);
        $_POST['update'] = null;
        $_POST['fLname'] = $details['firstName'] . ' '. $lastName =$details['lastName'];
    }
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trip account</title>
    <link rel="stylesheet" href="./css/account.css">
</head>
<body>
<div class="grand_parent">
    <div class="parent_i">
        <div class="parent_1">
            <div class="logo">
                <img src="./svg/logo_.svg" alt="logo">
            </div>
            <div class="passport">
                <img id="passport" src="./images/profile.png" alt="">
            </div>
            <form method="post" action="account.php" class="content">
                <div class="name_dob">
                    <div class="name">
                        <label for="text">Name:</label>
                        <input  type="text" name="fLname" value="<?php echo $_POST['fLname'] ?>" readonly>
                    </div>
                    <div class="dob">
                        <label for="text">Date of birth:</label>
                        <input type="text" name="dob" value="<?php global $details; echo  $details['dateOfBirth']; ?>" readonly>

                    </div>
                    <div class="section_1">
                        <a href="./signin.php"><p>Click here to Sign in.</p></a>
                    </div>
                </div>
                <div class="content_2">
                    <div class="email">
                        <label for="email">Email:</label>
                        <input id="stat_email" type="email" name="stat_email" value=" <?php global $details; echo  $details['email']; ?>" readonly>
                    </div>
                    <div class="password">
                        <label for="text">Password:</label>
                        <input type="text" name="stat_password" value="<?php global $details; echo  $details['password']; ?>" readonly>

                    </div>
                    <div class="button_link">

                        <div class="section_2" >
                            <input name="delete" class="delete" type="submit" value="Delete Account">
                        </div>

                    </div>

                </div>
            </form>

        </div>

    </div>

    <div class="parent_2">
        <form action="account.php" method="post" class="form_update">
            <div class="title">
                <h3>Update Login Details</h3>
            </div>

            <span class="email">
                    <label class="label_email" for="email">Email</label>
                    <input type="email" name="email" required>
                </span>


            <div class="pswd">
                <label for="password">Password</label>
                <input type="password" name="password" required>

            </div>
            <div class="re_psw">
                <label for="password">Re-Enter Password</label>
                <input type="password" name="cpassword" required>

            </div>
            <p class="warning"><?php
                   global $data_check;
                   global $verification;
                   global $details;

                   if(isset($_POST['update']) && $verification == false){
                       echo $data_check;
                   }
                   ?> </p>
            <input class="update" type="submit" NAME="update" value="Update">

        </form>
    </div>
    <div class="container_b">
        <div class="heading_3">
            <h3 id="heading_3">Create a Strong Password</h3>
        </div>
        <div class="list">
            <ul>
                <li>Password must contain at least one uppercase letter</li>
                <li>Password must contain at leats one special character</li>
                <li>Password must have a minimum lenght of eight (8) characters</li>
                <li>Password must contain at least one number</li>
            </ul>

        </div>




    </div>
</body>
</html>