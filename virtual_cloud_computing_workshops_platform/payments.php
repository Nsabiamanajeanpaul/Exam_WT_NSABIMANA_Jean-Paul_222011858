<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Information</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    /* CSS styles for consistent styling */
    a:link {
      color: #0066cc;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }

    a {
      padding: 7px;
      color: white;
      background-color: turquoise;
      text-decoration: none;
      margin-right: 5px;
    }

    a:visited {
      color: purple;
    }

    a:link {
      color: brown;
    }

    a:hover {
      background-color: white;
    }

    a:active {
      background-color: red;
    }

    button.btn {
      margin-left: 20px; 
      margin-top: 10px;
    }

    input.form-control {
      padding: 10px;
    }

    table {
      width: 100%;
      border-collapse: revert;
    }

    td:first-child {
      background-color: #333333;
      color: #ffffff;
    }

    td {
      padding: 8px;
      border-bottom: 1px solid #dddddd;
    }

    tr:hover {
      background-color: #e9e9e9;
    }

    th, td {
      border: 2px solid black;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: orange;
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; 
    }
header {
      text-align: center;
      padding: 30px;
      background-color: blue;
    }
    .search-form {
      position: fixed;
      top: 70px;
      left: 30px;
      z-index: 999; /* Ensure search bar appears above other content */
    }
    footer {
      text-align: center; 
      padding: 10px; 
      background-color: blue; 
    }
  </style>
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: lightblue;">
  <header>
    <ul style="list-style-type: none; padding: 0;">
      <li style="display: inline; margin-right: 10px;">
           <ul style="list-style-type: none; padding: 0;">
    </li>
    <li style="display: inline; margin-right: 8px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">WORKSHOPS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./resources.php">RESOURCES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payments.php">PAYMENTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./notifications.php">NOTIFICATIONS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./materials.php"> MATERIALS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">INSTRUCTORS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">FEEDBACK</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./enrollment.php">ENROLLMENT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">ATTENDEES</a></li>
     
      <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="logout.php">Logout</a>
        </div>
      </a>
    </li>
    </ul>
  </header>
<body style="background-color: yellowgreen;">
  <div class="search-form">
      <!-- Search form -->
      <form role="search" action="search.php">
        <input class="form-control" type="search" placeholder="search..." aria-label="search" name="query">
        <button class="btn" type="submit">search</button>
      </form>
    </div>

    <h1>Payment Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="payment_id">Payment ID:</label>
        <input type="number" id="payment_id" name="payment_id" required><br><br>

        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" id="workshop_id" name="workshop_id" required><br><br>

        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br><br>

        <label for="payment_date">Payment Date:</label>
        <input type="datetime-local" id="payment_date" name="payment_date" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a> 
    </form>

    <?php
    include('database_connection.php'); 

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        $payment_id = $_POST['payment_id'];
        $user_id = $_POST['user_id'];
        $workshop_id = $_POST['workshop_id'];
        $amount = $_POST['amount'];
        $payment_date = $_POST['payment_date'];

        $stmt = $connection->prepare("INSERT INTO payments (payment_id, user_id, workshop_id, amount, payment_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iiids", $payment_id, $user_id, $workshop_id, $amount, $payment_date);

        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br><a href='payments.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        $stmt->close();
    }
    ?>

    <section>
        <h2>Payment Detail</h2>
        <table>
            <tr>
                <th>Payment ID</th>
                <th>User ID</th>
                <th>Workshop ID</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            $sql = "SELECT * FROM payments";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['payment_id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['workshop_id']}</td>
                            <td>{$row['amount']}</td>
                            <td>{$row['payment_date']}</td>
                            <td><a style='padding:4px' href='delete_payments.php?payment_id={$row['payment_id']}'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_payments.php?payment_id={$row['payment_id']}'>Update</a></td> 
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <h2>UR CBE BIT &copy; 2024 &reg; WEB TECHNOLOGY</h2>
    </footer>

</body>
</html>
