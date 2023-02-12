<?php
include 'db.php';
global $connection;
$verify = null;


function signin_ver($email, $password){
    global $verify;
    global $connection;
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection,$query );
    while($row = mysqli_fetch_assoc($result)){
        if($row['email']==$email && $row['password']== $password){
            echo "account verified";

            $verify= true;
            break;
        }
    }
}
