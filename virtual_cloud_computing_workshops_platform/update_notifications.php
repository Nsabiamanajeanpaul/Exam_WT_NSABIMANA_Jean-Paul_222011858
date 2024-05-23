<?php
    // Connection details
    include('database_connection.php');

    // Check if notification_id is set
    if(isset($_REQUEST['notification_id'])) {
        $notification_id = $_REQUEST['notification_id'];
        
        $stmt = $connection->prepare("SELECT * FROM notifications WHERE notification_id=?");
        $stmt->bind_param("i", $notification_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $message = $row['message'];
            $sent_date = $row['sent_date'];
        } else {
            echo "Notification not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Notification</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Notification form -->
    <h2><u>Update Form of Notification</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="notification_id" value="<?php echo $notification_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="message">Message:</label>
        <input type="text" name="message" value="<?php echo $message; ?>">
        <br><br>

        <label for="sent_date">Date Sent:</label>
        <input type="date" name="sent_date" value="<?php echo $sent_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $notification_id = $_POST['notification_id'];
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];
    $sent_date = $_POST['sent_date'];
    
    // Update the notification record in the database
    $stmt = $connection->prepare("UPDATE notifications SET user_id=?, message=?, sent_date=? WHERE notification_id=?");
    $stmt->bind_param("issi", $user_id, $message, $sent_date, $notification_id);
    $stmt->execute();
    
    // Redirect to notifications.php or any other page displaying notification records
    header('Location: notifications.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
