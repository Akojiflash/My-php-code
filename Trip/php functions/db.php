<?php
$connection = mysqli_connect('localhost', 'root', '','trip' );
if(!isset($connection)){
    echo "Error connecting to server";

}