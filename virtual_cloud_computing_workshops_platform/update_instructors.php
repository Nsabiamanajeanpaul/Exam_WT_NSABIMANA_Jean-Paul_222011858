<?php
    // Connection details
    include('database_connection.php');

    // Check if instructor_id is set
    if(isset($_REQUEST['instructor_id'])) {
        $instructor_id = $_REQUEST['instructor_id'];
        
        $stmt = $connection->prepare("SELECT * FROM instructors WHERE instructor_id=?");
        $stmt->bind_param("i", $instructor_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $experience_years = $row['experience_years'];
            $specialization = $row['specialization'];
            $website = $row['website'];
        } else {
            echo "Instructor not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Instructor</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Instructor form -->
    <h2><u>Update Form of Instructor</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="instructor_id" value="<?php echo $instructor_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="experience_years">Experience (Years):</label>
        <input type="number" name="experience_years" value="<?php echo $experience_years; ?>">
        <br><br>

        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" value="<?php echo $specialization; ?>">
        <br><br>

        <label for="website">Website:</label>
        <input type="text" name="website" value="<?php echo $website; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $instructor_id = $_POST['instructor_id'];
    $user_id = $_POST['user_id'];
    $experience_years = $_POST['experience_years'];
    $specialization = $_POST['specialization'];
    $website = $_POST['website'];
    
    // Update the instructor record in the database
    $stmt = $connection->prepare("UPDATE instructors SET user_id=?, experience_years=?, specialization=?, website=? WHERE instructor_id=?");
    $stmt->bind_param("iissi", $user_id, $experience_years, $specialization, $website, $instructor_id);
    $stmt->execute();
    
    // Redirect to instructors.php or any other page displaying instructor records
    header('Location: instructors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
