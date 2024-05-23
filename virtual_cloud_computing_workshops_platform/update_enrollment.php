<?php
    // Connection details
    include('database_connection.php');

    // Check if enrollment_id is set
    if(isset($_REQUEST['enrollment_id'])) {
        $enrollment_id = $_REQUEST['enrollment_id'];
        
        $stmt = $connection->prepare("SELECT * FROM enrollment WHERE enrollment_id=?");
        $stmt->bind_param("i", $enrollment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $workshop_id = $row['workshop_id'];
            $status = $row['status'];
        } else {
            echo "Enrollment not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Enrollment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Enrollment form -->
    <h2><u>Update Form of Enrollment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="enrollment_id" value="<?php echo $enrollment_id; ?>">
        
        <label for="user_id">user ID:</label>
        <input type="number" name="user_id" value="<?php echo $user_iduser_id ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo $workshop_id; ?>">
        <br><br>

        <label for="status">status:</label>
        <input type="text" name="status" value="<?php echo $status; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $enrollment_id = $_POST['enrollment_id'];
    $user_id = $_POST['user_id'];
    $workshop_id = $_POST['workshop_id'];
    $status = $_POST['status'];
    
    // Update the enrollment record in the database
    $stmt = $connection->prepare("UPDATE enrollment SET user_id=?, workshop_id=?, status=? WHERE enrollment_id=?");
    $stmt->bind_param("iisi", $user_id, $workshop_id, $status, $enrollment_id);
    $stmt->execute();
    
    // Redirect to enrollments.php or any other page displaying enrollment records
    header('Location: enrollment.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>