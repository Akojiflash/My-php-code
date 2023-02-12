<?php

include './php functions/db.php';
global $connection;
$verify=false;

function account_details($email, $password){
    global $connection;
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($result)){
        if ($row['email'] == $email && $row['password'] == $password){
            return $row;
        }
    }
}


function delete_account($email, $password){
    global $connection;
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);
    $id = null;

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email && $row['password'] == $password) {
            $id = $row['id'];
            break;
        }
    }
    $query2 = "DELETE FROM users WHERE id = $id";
    $delete = mysqli_query($connection, $query2);
}


function email_ver($email)
{
    global $verify;
    global $connection;
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $email) {
            $verify = true;
            break;
        }
    }
}


function update_users($email, $password, $cpassword){
    $verification = null;
    global $connection;
    global $verify;
    $pass_length = strlen($password);
    $check = null;
    $check_num = null;
    email_ver($email);
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);
    $id = null;
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['email'] == $_SESSION['email'] && $row['password'] == $_SESSION['password']) {
            $id = $row['id'];
            break;
        }
    }
    for ($i = 0; $i < strlen($password); $i++) {
        if (ctype_upper($password[$i])) {
            $check = true;
            break;
        }
    }
    for ($i = 0; $i < strlen($password); $i++) {
        if (str_contains('1234567890', $password[$i])) {
            $check_num = true;
            break;
        }
    }
    if (strlen($password) >= 8 && $password == $cpassword && preg_match(' /[ \' ^£$%&*()}{@#~?<>,|=_+-]/',
            $password) && isset($check) && isset($check_num) && $verify == false)  {
        $query2 = "UPDATE users SET ";
        $query2 .= "email = '$email', ";
        $query2 .=  "password = '$password' ";
        $query2 .= "WHERE id = $id ";
        $update = mysqli_query($connection, $query2);
        if (!$update) {
            die("Data not saved" . mysqli_error($connection));

        } else {
            $verification =true;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            return (" Account Updated successfully  ");
        }
    }elseif ($verify==true){
        $verification = false;
        return "Email account already exists";

    }  elseif ($pass_length < 8) {
        $verification = false;
        return ("The password you entered is less than the minimum length");

    } elseif ($password != $cpassword) {
        $verification = false;
        return ("The password you entered does not match each other");

    } elseif (preg_match(' /[ \' ^£$%&*()}{@#~?<>,|=_+-]/', $password) == false) {
        $verification = false;
        return "Password must include a special character";

    } elseif ($check == null) {
        $verification = false;
        return (" The password you entered does not contain any upper case character ");

    } elseif ($check_num == null) {
        $verification = false;
        return("The password you entered does not contain any numeric character");

    } else {
        $verification = false;
        return ("Form cannot be left blank");

    }
}



