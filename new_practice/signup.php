<?php
include './php/signup_func.php';
$sign_up = null;
session_start();

if (isset($_POST["signup"])) {
    $sign_up = account_ver($_POST["first_name"],$_POST["last_name"],
        $_POST["email"], $_POST["password"],$_POST["repassword"]   );
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/signup.css">
    <title>Sign up</title>
</head>

<body>
    <div class="card-container">
        <div class="card">

            <ul>
                <h4>Note: </h4>
                <li>Password must contain at least one uppercase letter</li>
                <li>Password must contain at leats one special character</li>
                <li>Password must have a minimum lenght of eight (8) characters</li>
                <li>Password must contain at least one number</li>

                <div class="news" style="color: red">
                    <?php
                    global $condition;
                    if($condition && isset($_POST["signup"])){
                        header('location: ./account.php');
                        $_SESSION['email'] = $_POST['email'];
                        $_SESSION['password'] = $_POST['password'];
                        echo "<h3>Account created successlly</h3>";
                    }
                    elseif (!$condition && isset($_POST["signup"])){

                        echo "<h3>Account creation failed</h3>";
                    }
                    ?>
                </div>

            </ul>
        </div>

        <form action="./signup.php" method="post">
            <h3 class="heading">Practice Sign up page</h3>
    
            <div class="container">
                <div class="firstname">
                    <label for="text" id="label">First name</label><br>
                    <input type="text" name="first_name" required>
                </div>
                <div class="lastname">
                    <label for="text" id="label">Last name</label><br>
                    <input type="text" name="last_name" required>
                </div>
    
            </div>
    
    
            
    
            <div class="container_1">
                <div class="email">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" required>
                </div>
            </div>
    
            <div class="container_2">
    
                <div class="password">
                    <label for="password">Password</label><br>
                    <input type="password" name="password">
    
                </div>
    
                <div class="repassword">
    
                    <label for="password">Re-type Password</label><br>
                    <input type="password" name="repassword">
                </div>
    
                <br>
    
            </div>
            <div class="submit">
                <input type="submit" name="signup" value="Sign up">
            </div>
            <div class="para">
                <p>Already have an account? <a href="index.php">Sign in</a></p>
                <div class="news" style="color: red">
                    <?php
                    global $condition;
                    if($condition && isset($_POST["signup"])){
                        echo $sign_up;

                    }
                    elseif (!$condition && isset($_POST["signup"])){
                        echo $sign_up;

                    }
                    ?>
                </div>

            </div>
        </form>

    </div>
    
</body>

</html>