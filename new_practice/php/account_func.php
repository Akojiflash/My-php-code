<?php
$connection = mysqli_connect("localhost", "root", "", "signup_test");

if ($connection) {
    echo "We are in <br>";
} else {
    die("conection failed");
}






function query($email, $password)
{

    global $connection;
    $query = "SELECT * FROM users ";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_row($result)) {
        if ($row[3] == $email && $row[4] == $password) {
            return $row;

            break;

        }

    }

}

function detail_update( $email, $password, $id){
    global $connection;

    if (strlen($password) < 8) {
    return false;

}else{
        $update = "UPDATE users SET email = '$email', password = '$password' ";
        $update .=" WHERE id = $id ";
        $result = mysqli_query($connection, $update);
        if(!$result){
            die("Query failed" . mysqli_error($connection));
        }return true;

    }


}

?>
<!--<link rel="stylesheet" href="../css/styles.css">-->