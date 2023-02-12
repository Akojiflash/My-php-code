<?php

$verification = null;
$id = null;
$verify = false;


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


function collect_data($firstName, $lastName, $email, $dob,$password, $cpassword){
    global $connection;
    global $verification;
    global $verify;
    $pass_length = strlen($password);
    $check = null;
    $check_num = null;
    email_ver($email);

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

    if (strlen($firstName) < 2 || strlen($lastName) < 2) {
        echo "First name and last must be at least two characters long";
        return false;
    } elseif (strlen($password) >= 8 && $password == $cpassword && preg_match(' /[ \' ^£$%&*()}{@#~?<>,|=_+-]/',
            $password) && isset($check) && isset($check_num) && $verify==false) {

        $query = "INSERT INTO users (firstName, lastName, email,dateOfBirth , password)";
        $query .= "VALUES ('$firstName', '$lastName', '$email', '$dob', '$password')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Data not saved" . mysqli_error($connection));

        } else {
            $verification =true;
            return (" Account Created successfully  ");
        }
    } elseif ($verify==true){
        $verification = false;
        return "Email account already exists";

    }elseif ($pass_length < 8) {
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