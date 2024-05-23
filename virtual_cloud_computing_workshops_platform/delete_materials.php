<?php
    // Connection details
    include('database_connection.php');

    // Check if material_id is set
    if(isset($_REQUEST['material_id'])) {
        $material_id = $_REQUEST['material_id'];

        // Prepare and execute the DELETE statement for the materials table
        $stmt = $connection->prepare("DELETE FROM materials WHERE material_id=?");
        $stmt->bind_param("i", $material_id);

        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Delete Record</title>
            <script>
                function confirmDelete() {
                    return confirm("Are you sure you want to delete this record?");
                }
            </script>
        </head>
        <body>
            <form method="post" onsubmit="return confirmDelete();">
                <input type="hidden" name="material_id" value="<?php echo $material_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='materials.php'>OK</a>"; // Assuming materials.php is the page displaying material records
                } else {
                    echo "Error deleting data: " . $stmt->error;
                }
            }
            ?>
        </body>
        </html>
        <?php

        $stmt->close();
    } else {
        echo "material_id is not set.";
    }

    $connection->close();
?>
