<?php
    // Connection details
    include('database_connection.php');

    // Check if attendee_id is set
    if(isset($_REQUEST['attendee_id'])) {
        $attendee_id = $_REQUEST['attendee_id'];
        
        $stmt = $connection->prepare("SELECT * FROM attendees WHERE attendee_id=?");
        $stmt->bind_param("i", $attendee_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $workshop_type = $row['workshop_type'];
            $registration_date = $row['registration_date'];
        } else {
            echo "Attendee not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendee</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Attendee form -->
    <h2><u>Update Form of Attendee</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="attendee_id" value="<?php echo $attendee_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="workshop_type">Workshop Type:</label>
        <input type="text" name="workshop_type" value="<?php echo $workshop_type; ?>">
        <br><br>

        <label for="registration_date">Registration Date:</label>
        <input type="date" name="registration_date" value="<?php echo $registration_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $attendee_id = $_POST['attendee_id'];
    $user_id = $_POST['user_id'];
    $workshop_type = $_POST['workshop_type'];
    $registration_date = $_POST['registration_date'];
    
    // Update the attendee record in the database
    $stmt = $connection->prepare("UPDATE attendees SET user_id=?, workshop_type=?, registration_date=? WHERE attendee_id=?");
    $stmt->bind_param("issi", $user_id, $workshop_type, $registration_date, $attendee_id);
    $stmt->execute();
    
    // Redirect to attendees.php or any other page displaying attendee records
    header('Location: attendees.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
