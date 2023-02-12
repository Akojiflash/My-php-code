<?php
$connection = mysqli_connect('localhost', 'root', '', 'signup_test');
if(!$connection){
    die('Not connected');
}else{
    echo "Connected to database server";
}
