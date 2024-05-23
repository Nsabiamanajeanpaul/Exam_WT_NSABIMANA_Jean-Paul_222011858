<?php
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $username  = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $registration_date = $_POST['registration_date'];
    
    $sql = "INSERT INTO users (username, email, password, registration_date) VALUES ('$username', '$email', '$password', '$registration_date')";

    if ($connection->query($sql) === TRUE) {
        header("Location: login.html");
        exit();
    } 
    else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
$connection->close();
?>
