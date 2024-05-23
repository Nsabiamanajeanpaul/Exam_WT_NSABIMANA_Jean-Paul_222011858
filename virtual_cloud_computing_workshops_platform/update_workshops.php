<?php
    // Connection details
    include('database_connection.php');

    // Check if workshop_id is set
    if(isset($_REQUEST['workshop_id'])) {
        $workshop_id = $_REQUEST['workshop_id'];
        
        $stmt = $connection->prepare("SELECT * FROM workshops WHERE workshop_id=?");
        $stmt->bind_param("i", $workshop_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $instructor_id = $row['instructor_id'];
            $title = $row['title'];
            $description = $row['description'];
            $start_date = $row['start_date'];
            $end_date = $row['end_date'];
        } else {
            echo "Workshop not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Workshop form -->
    <h2><u>Update Form of Workshop</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="workshop_id" value="<?php echo $workshop_id; ?>">
        
        <label for="instructor_id">Instructor ID:</label>
        <input type="number" name="instructor_id" value="<?php echo $instructor_id; ?>">
        <br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $title; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $description; ?>">
        <br><br>

        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" value="<?php echo $start_date; ?>">
        <br><br>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" value="<?php echo $end_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $workshop_id = $_POST['workshop_id'];
    $instructor_id = $_POST['instructor_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    
    // Update the workshop record in the database
    $stmt = $connection->prepare("UPDATE workshops SET instructor_id=?, title=?, description=?, start_date=?, end_date=? WHERE workshop_id=?");
    $stmt->bind_param("issssi", $instructor_id, $title, $description, $start_date, $end_date, $workshop_id);
    $stmt->execute();
    
    // Redirect to workshops.php or any other page displaying workshop records
    header('Location: workshops.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
