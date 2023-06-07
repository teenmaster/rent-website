<?php

// Connect to the MySQL database
$mysqli = new mysqli("localhost", "username", "email", "password" , "registration");

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the user is trying to register
if (isset($_POST['register'])) {

    // Check if the username is already taken
    $sql = "SELECT * FROM signup WHERE username = '" . $_POST['username'] . "'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "Username already taken";
    } else {

        // Hash the password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO signup (username, email, password) VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $password . "')";
        $result = $mysqli->query($sql);

        if ($result) {
            echo "User registered successfully";
        } else {
            echo "Error registering user: " . $mysqli->error;
        }
    }
}

// Close the connection to the MySQL database
$mysqli->close();

?>