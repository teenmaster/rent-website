<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login-php</title>
</head>
<body>

<?php

// Connect to the MySQL database
$mysqli = new mysqli("localhost", "username", "password", "database_name");

// Check if the connection was successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if the user is trying to register
if (isset($_POST['register'])) {

    // Check if the username is already taken
    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        echo "Username already taken";
    } else {

        // Hash the password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Insert the user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('" . $_POST['username'] . "', '" . $_POST['email'] . "', '" . $password . "')";
        $result = $mysqli->query($sql);

        if ($result) {
            echo "User registered successfully";
        } else {
            echo "Error registering user: " . $mysqli->error;
        }
    }
}

// Check if the user is trying to login
if (isset($_POST['login'])) {

    // Check if the username and password are correct
    $sql = "SELECT * FROM users WHERE username = '" . $_POST['username'] . "' AND password = '" . $_POST['password'] . "'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {

        // Login the user
        $_SESSION['username'] = $_POST['username'];
        header("Location: home.php");
    } else {
        echo "Username or password incorrect";
    }
}

// Close the connection to the MySQL database
$mysqli->close();

?>
    
</body>
</html>