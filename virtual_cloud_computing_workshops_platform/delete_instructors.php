<?php
    // Connection details
    include('database_connection.php');

    // Check if instructor_id is set
    if(isset($_REQUEST['instructor_id'])) {
        $instructor_id = $_REQUEST['instructor_id'];

        // Prepare and execute the DELETE statement for the instructors table
        $stmt = $connection->prepare("DELETE FROM instructors WHERE instructor_id=?");
        $stmt->bind_param("i", $instructor_id);

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
                <input type="hidden" name="instructor_id" value="<?php echo $instructor_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='instructors.php'>OK</a>"; // Assuming instructors.php is the page displaying instructor records
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
        echo "instructor_id is not set.";
    }

    $connection->close();
?>
