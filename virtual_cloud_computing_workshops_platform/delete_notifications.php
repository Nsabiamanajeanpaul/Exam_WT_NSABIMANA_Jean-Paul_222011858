<?php
    // Connection details
    include('database_connection.php');

    // Check if notification_id is set
    if(isset($_REQUEST['notification_id'])) {
        $notification_id = $_REQUEST['notification_id'];

        // Prepare and execute the DELETE statement for the notifications table
        $stmt = $connection->prepare("DELETE FROM notifications WHERE notification_id=?");
        $stmt->bind_param("i", $notification_id);

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
                <input type="hidden" name="notification_id" value="<?php echo $notification_id; ?>">
                <input type="submit" value="Delete">
            </form>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->execute()) {
                    echo "Record deleted successfully.<br><br>";
                    echo "<a href='notifications.php'>OK</a>"; // Assuming notifications.php is the page displaying notification records
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
        echo "notification_id is not set.";
    }

    $connection->close();
?>
