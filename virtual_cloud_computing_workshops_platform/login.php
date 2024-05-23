<?php
session_start(); // Start the session
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL statement to retrieve users data by email
    $sql = "SELECT user_id, password FROM users WHERE email=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Fetch user data
        $row = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variable and redirect to home.php
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: home.html");
            exit();
        } else {
            // Password is incorrect
            echo "Invalid email or password";
        }
    } else {
        // User not found
        echo "User not found";
    }
    
    // Close statement
    $stmt->close();
} else {
    // Invalid request method
    echo "Invalid request";
}

// Close connection
$connection->close();
?>
