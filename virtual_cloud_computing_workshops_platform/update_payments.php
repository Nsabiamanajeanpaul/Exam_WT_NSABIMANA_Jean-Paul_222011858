<?php
    // Connection details
    include('database_connection.php');

    // Check if payment_id is set
    if(isset($_REQUEST['payment_id'])) {
        $payment_id = $_REQUEST['payment_id'];
        
        $stmt = $connection->prepare("SELECT * FROM payments WHERE payment_id=?");
        $stmt->bind_param("i", $payment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];
            $workshop_id = $row['workshop_id'];
            $amount = $row['amount'];
            $payment_date = $row['payment_date'];
        } else {
            echo "Payment not found.";
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Payment</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Payment form -->
    <h2><u>Update Form of Payment</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="payment_id" value="<?php echo $payment_id; ?>">
        
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" value="<?php echo $user_id; ?>">
        <br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" name="workshop_id" value="<?php echo $workshop_id; ?>">
        <br><br>

        <label for="amount">Amount:</label>
        <input type="text" name="amount" value="<?php echo $amount; ?>">
        <br><br>

        <label for="payment_date">Payment Date:</label>
        <input type="date" name="payment_date" value="<?php echo $payment_date; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $payment_id = $_POST['payment_id'];
    $user_id = $_POST['user_id'];
    $workshop_id = $_POST['workshop_id'];
    $amount = $_POST['amount'];
    $payment_date = $_POST['payment_date'];
    
    // Update the payment record in the database
    $stmt = $connection->prepare("UPDATE payments SET user_id=?, workshop_id=?, amount=?, payment_date=? WHERE payment_id=?");
    $stmt->bind_param("iidsi", $user_id, $workshop_id, $amount, $payment_date, $payment_id);
    $stmt->execute();
    
    // Redirect to payments.php or any other page displaying payment records
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
