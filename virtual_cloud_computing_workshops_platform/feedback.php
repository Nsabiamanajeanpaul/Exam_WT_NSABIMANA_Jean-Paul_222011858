<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"> <!-- Proper character encoding -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Responsive design -->
  <title>Feedback Information</title>
  <link rel="stylesheet" type="text/css" href="style.css"> <!-- External CSS -->
  <style>
    /* CSS styles for consistent styling */
a:link {
    color: #0066cc;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Comments */
/* This is a comment */

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
      width: 100%; /* Set table to full width */
      border-collapse: revert; /* Merge borders */
      /* CSS for Table Design with Special First Column */

/* Table */
table {
    width: 70%;
    border-collapse: collapse;
}

/* Special Styling for First Column */
td:first-child {
    background-color: #333333;
    color: #ffffff;
}

/* Table Cells */
td {
    padding: 8px;
    border-bottom: 1px solid #dddddd;
}

/* Hover Effect */
tr:hover {
    background-color: #e9e9e9;
}

    }

    th, td {
      border: 2px solid black; /* Table borders */
      padding: 10px; /* Padding for readability */
      text-align: left;
    }

    th {
      background-color: orange; /* Header row color */
    }

    section {
      padding: 20px; 
      border-bottom: 3px solid #ddd; /* Bottom border for section */
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
      background-color: blue; /* Footer background color */
    }
  </style>
  <!-- JavaScript function for insert confirmation -->
  <script>
    function confirmInsert() {
      return confirm("Are you sure you want to insert this record?");
    }
  </script>
</head>

<body style="background-color: lightblue;"> <!-- Corrected placement of body tag -->
  <header>
    <ul style="list-style-type: none; padding: 0;"> <!-- No list-style -->
      <li style="display: inline; margin-right: 10px;">
           <ul style="list-style-type: none; padding: 0;">
    </li>
    <li style="display: inline; margin-right: 8px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">WORSHOPS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./resources.php">RESOURCES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./payments.php">PAYMENTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./notifications.php">NOTIFICATIONS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./materials.php">MATERIALS</a></li>
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

    <h1>Feedback Form</h1>
    <form method="post" onsubmit="return confirmInsert();">
        <label for="feedback_id">Feedback ID:</label>
        <input type="number" id="feedback_id" name="feedback_id" required><br><br>

        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="workshop_id">Workshop ID:</label>
        <input type="number" id="workshop_id" name="workshop_id" required><br><br>

        <label for="instructor_id">Instructor ID:</label>
        <input type="number" id="instructor_id" name="instructor_id" required><br><br>

        <label for="feedback_text">Feedback Text:</label>
        <input type="text" id="feedback_text" name="feedback_text" required><br><br>

        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a> <!-- Corrected the path to start with "./" -->
    </form>

    <?php
    include('database_connection.php'); // Include the database connection

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
        // Retrieve input values from POST request
        $feedback_id = $_POST['feedback_id'];
        $user_id = $_POST['user_id'];
        $workshop_id = $_POST['workshop_id'];
        $instructor_id = $_POST['instructor_id'];
        $feedback_text = $_POST['feedback_text'];
        $rating = $_POST['rating'];

        // Prepare SQL statement for insertion
        $stmt = $connection->prepare("INSERT INTO feedback (feedback_id, user_id, workshop_id, instructor_id, feedback_text, rating) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiiisi", $feedback_id, $user_id, $workshop_id, $instructor_id, $feedback_text, $rating); // Bind parameters

        // Execute the statement and check for success
        if ($stmt->execute()) {
            echo "New record has been added successfully.<br><br><a href='feedback.php'>Back to Form</a>";
        } else {
            echo "Error inserting data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
    ?>

    <section>
        <h2>Feedback Detail</h2>
        <table>
            <tr>
                <th>Feedback ID</th>
                <th>User ID</th>
                <th>Workshop ID</th>
                <th>Instructor ID</th>
                <th>Feedback Text</th>
                <th>Rating</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Select all feedback from the database
            $sql = "SELECT * FROM feedback";
            $result = $connection->query($sql); // Execute the query

            if ($result->num_rows > 0) {
                // Loop through the results and generate table rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['feedback_id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['workshop_id']}</td>
                            <td>{$row['instructor_id']}</td>
                            <td>{$row['feedback_text']}</td>
                            <td>{$row['rating']}</td>
                            <td><a style='padding:4px' href='delete_feedback.php?feedback_id={$row['feedback_id']}'>Delete</a></td> 
                            <td><a style='padding:4px' href='update_feedback.php?feedback_id={$row['feedback_id']}'>Update</a></td> 
                          </tr>";
                }
            } else {
                // If no data is found, display a message in the table
                echo "<tr><td colspan='8'>No data found</td></tr>";
            }
            ?>
        </table>
    </section>

    <footer>
        <h2>UR CBE BIT &copy; 2024 &reg; WEB TECHNOLOGY</h2> <!-- Corrected "Designer" to "Designed" -->
    </footer>

</body>
</html>
