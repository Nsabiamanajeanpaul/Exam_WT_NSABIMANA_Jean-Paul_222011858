<?php
    // Connection details
    include('database_connection.php');

    // Check if feedback_id is set
    if(isset($_REQUEST['feedback_id'])) {
        $feedback_id = $_REQUEST['feedback_id'];
        
        $stmt = $connection->prepare("SELECT * FROM feedback WHERE feedback_id=?");
        $stmt->bind_param("i", $feedback_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $workshop_id = $row['workshop_id'];
            $instructor_id = $row['instructor_id'];
            $feedback_text = $row['feedback_text'];
            $rating = $row['rating'];
        } else {
            echo "Feedback not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Feedback</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Feedback form -->
    <h2><u>Update Form of Feedback</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="feedback_id" value="<?php echo $feedback_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo $workshop_id; ?>">
        <br><br>

        <label for="instructor_id">Instructor ID:</label>
        <input type="number" name="instructor_id" value="<?php echo $instructor_id; ?>">
        <br><br>

        <label for="feedback_text">Feedback Text:</label>
        <input type="text" name="feedback_text" value="<?php echo $feedback_text; ?>">
        <br><br>

        <label for="rating">Rating:</label>
        <input type="number" name="rating" value="<?php echo $rating; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $feedback_id = $_POST['feedback_id'];
    $user_id = $_POST['user_id'];
    $workshop_id = $_POST['workshop_id'];
    $instructor_id = $_POST['instructor_id'];
    $feedback_text = $_POST['feedback_text'];
    $rating = $_POST['rating'];
    
    // Update the feedback record in the database
    $stmt = $connection->prepare("UPDATE feedback SET user_id=?, workshop_id=?, instructor_id=?, feedback_text=?, rating=? WHERE feedback_id=?");
    $stmt->bind_param("iiiisi", $user_id, $workshop_id, $instructor_id, $feedback_text, $rating, $feedback_id);
    $stmt->execute();
    
    // Redirect to feedback.php or any other page displaying feedback records
    header('Location: feedback.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
