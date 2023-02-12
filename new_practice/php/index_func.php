<?php

// Connect to the database server and select the database
$connection = mysqli_connect('localhost', 'root', '', 'signup_test');
if (!$connection) {
    die('Not connected');
} else {
    echo "Connected to database server";
}

// Define the detail_check() function

function detail_check($email, $password) {
    global $connection;

    // Retrieve all rows from the users table
    $query = "SELECT email, password FROM users";
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('QUERY FAILED' . mysqli_error($connection));
    }

    // Loop through the rows and check if the email and password match
    while ($row = mysqli_fetch_row($result)) {
        if ($row[0] == $email && $row[1] == $password) {
            return true;
        }
    }

    // If no match was found, return false
    return false;
}
