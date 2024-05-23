<?php
    // Connection details
    include('database_connection.php');

    // Check if material_id is set
    if(isset($_REQUEST['material_id'])) {
        $material_id = $_REQUEST['material_id'];
        
        $stmt = $connection->prepare("SELECT * FROM materials WHERE material_id=?");
        $stmt->bind_param("i", $material_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $workshop_id = $row['workshop_id'];
            $title = $row['title'];
            $file_path = $row['file_path'];
            $uploaded_date = $row['uploaded_date'];
        } else {
            echo "Material not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Material</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Material form -->
    <h2><u>Update Form of Material</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="material_id" value="<?php echo $material_id; ?>">
        
        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo $workshop_id; ?>">
        <br><br>

        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $title; ?>">
        <br><br>

        <label for="file_path">File Path:</label>
        <input type="text" name="file_path" value="<?php echo $file_path; ?>">
        <br><br>

        <label for="uploaded_date">Uploaded Date:</label>
        <input type="date" name="uploaded_date" value="<?php echo $uploaded_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $material_id = $_POST['material_id'];
    $workshop_id = $_POST['workshop_id'];
    $title = $_POST['title'];
    $file_path = $_POST['file_path'];
    $uploaded_date = $_POST['uploaded_date'];
    
    // Update the material record in the database
    $stmt = $connection->prepare("UPDATE materials SET workshop_id=?, title=?, file_path=?, uploaded_date=? WHERE material_id=?");
    $stmt->bind_param("issii", $workshop_id, $title, $file_path, $uploaded_date, $material_id);
    $stmt->execute();
    
    // Redirect to materials.php or any other page displaying material records
    header('Location: materials.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
