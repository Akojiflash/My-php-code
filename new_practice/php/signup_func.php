<?php


$connection = mysqli_connect("localhost", "root", "", "signup_test");

if ($connection) {
    echo "We are in <br>";
} else {
    die("conection failed");
}

$condition = null;


function account_ver($firstName, $lastName, $email, $password, $repassword)
{

    global $connection;
    global $condition;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $pass_length = strlen($password);
    $check = null;
    $check_num = null;



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
    } elseif (strlen($password) >= 8 && $password == $repassword && preg_match(' /[ \' ^£$%&*()}{@#~?<>,|=_+-]/',
            $password) && isset($check) && isset($check_num)) {
        $query = "INSERT INTO users (firstName, lastName, email, password)";
        $query .= "VALUES ('$firstName', '$lastName', '$email', '$password')";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            die("Data not saved" . mysqli_error($connection));

        } else {

            $condition =true;

            return (" Account Created successfully  ");

        }

    }  elseif ($pass_length < 8) {
        $condition = false;
        return ("The password you entered is less than the minimum length");

    } elseif ($password != $_POST['repassword']) {
        $condition = false;
        return ("The password you entered does not match eachother");

    } elseif (preg_match(' /[ \' ^£$%&*()}{@#~?<>,|=_+-]/', $password) == false) {
        echo "Password must include a special character";
    } elseif ($check == null) {
        $condition = false;
        return (" The password you entered does not contain any upper case character ");

    } elseif ($check_num == null) {
        $condition = false;
        return("The password you entered does not contain any numeric character");

    } else {
        $condition = false;
        return ("Form cannot be left blank");

    }
}

//?>
