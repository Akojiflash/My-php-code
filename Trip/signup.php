<?php
include './php functions/db.php';
include './php functions/signup_func.php';

session_start();
$data_check =  null;
if(isset($_POST['submit'])){
    $data_check= collect_data($_POST['firstName'],$_POST['lastname'],$_POST['email'],$_POST['dob'],$_POST['password'],$_POST['cpassword']);

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trip sign up</title>
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>

<div>
    <img src="./svg/logo.svg" alt="logo">
   <div class="grand_parent">
       <div id="heading">
           <h2 class="heading">Sign up</h2>

       </div>
       <div class="parent_container">


           <form action="signup.php" method="post">
               <div class="names">
                   <div class="first_name">
                       <label for="text">First name</label>
                       <input type="text" name="firstName" required>
                   </div>
                   <div class="lastname">
                       <label for="text">Last name</label>
                       <input type="text" name="lastname" required>

                   </div>
               </div>
               <div class="email_dob">
                   <div class="email">
                       <label for="email">Email</label>
                       <input type="email" name="email" required>
                   </div>
                   <div class="date">
                       <label for="date">Date of birth</label>
                       <input type="date" name="dob" required>

                   </div>
               </div>
               <div class="heading_2">
                   <h3>Create Password</h3>
               </div>
                <div class="psw_field">
                        <div class="password">
                            <label for="password">Password</label>
                            <input type="password" name="password" required>
                        </div>
                        <div class="re_psw">
                            <label for="password">Re-Enter Password</label>
                            <input type="password" name="cpassword" required>

                        </div>
                </div>
               <p><?php
                   global $data_check;
                   global $verification;
                   if(isset($_POST['submit']) && $verification == false){
                       echo $data_check;
                   }elseif (isset($_POST['submit']) && $verification == true){
                       header('location: ./account.php');
                       $_SESSION['email'] = $_POST['email'];
                       $_SESSION['password'] = $_POST['password'];



                   }
                   ?></p>
               <div class="btn_signin">
                   <div class="signin">
                       <p class="already">Already have an account? <a class="click_here" href="./signin.php">Click here to sign in</a> </p>
                   </div>

                   <div class="submit">
                       <input type="submit" name="submit" value="Sign up">
                   </div>
               </div>
           </form>


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
       </div>

   </div>



</div>

</body>
</html>
