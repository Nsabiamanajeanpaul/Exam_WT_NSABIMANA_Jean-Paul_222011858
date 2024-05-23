<?php
    // Connection details
    include('database_connection.php');

    // Check if resource_id is set
    if(isset($_REQUEST['resource_id'])) {
        $resource_id = $_REQUEST['resource_id'];
        
        $stmt = $connection->prepare("SELECT * FROM resources WHERE resource_id=?");
        $stmt->bind_param("i", $resource_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $resource_name = $row['resource_name'];
            $description = $row['description'];
        } else {
            echo "Resource not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Resource</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Resource form -->
    <h2><u>Update Form of Resource</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="resource_id" value="<?php echo $resource_id; ?>">
        
        <label for="resource_name">Resource Name:</label>
        <input type="text" name="resource_name" value="<?php echo $resource_name; ?>">
        <br><br>

        <label for="description">Description:</label>
        <input type="text" name="description" value="<?php echo $description; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $resource_id = $_POST['resource_id'];
    $resource_name = $_POST['resource_name'];
    $description = $_POST['description'];
    
    // Update the resource record in the database
    $stmt = $connection->prepare("UPDATE resources SET resource_name=?, description=? WHERE resource_id=?");
    $stmt->bind_param("ssi", $resource_name, $description, $resource_id);
    $stmt->execute();
    
    // Redirect to resources.php or any other page displaying resource records
    header('Location: resources.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
