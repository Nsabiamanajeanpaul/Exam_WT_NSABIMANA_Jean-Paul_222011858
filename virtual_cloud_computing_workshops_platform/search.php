<?php
include('database_connection.php');

if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Define the columns to search in workshops table
    $workshopColumns = ['workshop_id', 'instructor_id', 'title', 'description', 'start_date','end_date'];
    $sql = "SELECT * FROM workshops WHERE ";
    foreach ($workshopColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_workshops = $connection->query($sql);

    // Define the columns to search in notifications table
    $notificationColumns = ['notification_id', 'user_id', 'message', 'sent_date'];
    $sql = "SELECT * FROM notifications WHERE ";
    foreach ($notificationColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_notifications = $connection->query($sql);

    // Define the columns to search in resources table
    $resourceColumns = ['resource_id', 'resource_name', 'description'];
    $sql = "SELECT * FROM resources WHERE ";
    foreach ($resourceColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_resources = $connection->query($sql);

    // Define the columns to search in materials table
    $materialColumns = ['material_id', 'workshop_id', 'title', 'file_path', 'uploaded_date'];
    $sql = "SELECT * FROM materials WHERE ";
    foreach ($materialColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_materials = $connection->query($sql);

    // Define the columns to search in instructors table
    $instructorColumns = ['instructor_id', 'user_id', 'experience_years', 'specialization','website'];
    $sql = "SELECT * FROM instructors WHERE ";
    foreach ($instructorColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_instructors = $connection->query($sql);

     // Define the columns to search in feedback table
    $feedbackColumns = ['feedback_id', 'user_id', 'workshop_id', 'instructor_id', 'feedback_text', 'rating'];
    $sql = "SELECT * FROM feedback WHERE ";
    foreach ($feedbackColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_feedback = $connection->query($sql);

    // Define the columns to search in enrollment table
    $enrollmentColumns = ['enrollment_id', 'user_id', 'workshop_id', 'status'];
    $sql = "SELECT * FROM enrollment WHERE ";
    foreach ($enrollmentColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_enrollment = $connection->query($sql);

    // Define the columns to search in attendees table
    $attendeeColumns = ['attendee_id', 'user_id', 'workshop_type', 'registration_date'];
    $sql = "SELECT * FROM attendees WHERE ";
    foreach ($attendeeColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_attendees = $connection->query($sql);

    // Define the columns to search in payments table
    $paymentColumns = ['payment_id', 'user_id', 'workshop_id', 'amount', 'payment_date'];
    $sql = "SELECT * FROM payments WHERE ";
    foreach ($paymentColumns as $column) {
        $sql .= "$column LIKE '%$searchTerm%' OR ";
    }
    $sql = rtrim($sql, "OR ");
    $result_payment = $connection->query($sql);

    // Output search results
    echo "<h3>notifications:</h3>";
    if ($result_notifications->num_rows > 0) {
        while ($row = $result_notifications->fetch_assoc()) {
            echo "<p>notification_id: " . $row['notification_id'] . "</p>";
            echo "<p>user_id: " . $row['user_id'] . "</p>";
            echo "<p>message: " . $row['message'] . "</p>";
            echo "<p>sent_date: " . $row['sent_date'] . "</p>";
        }
    } else {
        echo "<p>No notifications found matching the search term: " . $searchTerm . "</p>";
    }

   echo "<h3>workshops:</h3>";
    if ($result_workshops->num_rows > 0) {
        while ($row = $result_workshops->fetch_assoc()) {
            echo "<p>workshop_id: " . $row['workshop_id'] . "</p>";
            echo "<p>instructor_id: " . $row['instructor_id'] . "</p>";
            echo "<p>title: " . $row['title'] . "</p>";
            echo "<p>description: " . $row['description'] . "</p>";
            echo "<p>start_date: " . $row['start_date'] . "</p>";
            echo "<p>end_date: " . $row['end_date'] . "</p>";
    
        }
    } else {
        echo "<p>No workshops found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>resources:</h3>";
    if ($result_resources->num_rows > 0) {
        while ($row = $result_resources->fetch_assoc()) {
            echo "<p>resource_id: " . $row['resource_id'] . "</p>";
            echo "<p>resource_name: " . $row['resource_name'] . "</p>";
            echo "<p>description: " . $row['description'] . "</p>";
        }
    } else {
        echo "<p>No resources found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>materials:</h3>";
    if ($result_materials->num_rows > 0) {
        while ($row = $result_materials->fetch_assoc()) {
            echo "<p>material_id: " . $row['material_id'] . "</p>";
            echo "<p>workshop_id: " . $row['workshop_id'] . "</p>";
            echo "<p>title: " . $row['title'] . "</p>";
            echo "<p>file_path: " . $row['file_path'] . "</p>";
            echo "<p>uploaded_date: " . $row['uploaded_date'] . "</p>";
        }
    } else {
        echo "<p>No materials found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>instructors:</h3>";
    if ($result_instructors->num_rows > 0) {
        while ($row = $result_instructors->fetch_assoc()) {
            echo "<p>instructor_id: " . $row['instructor_id'] . "</p>";
            echo "<p>user_id: " . $row['user_id'] . "</p>";
            echo "<p>experience_years: " . $row['experience_years'] . "</p>";
            echo "<p>specialization: " . $row['specialization'] . "</p>";
            echo "<p>website: " . $row['website'] . "</p>";
        }
    } else {
        echo "<p>No instructors found matching the search term: " . $searchTerm . "</p>";
    }

   echo "<h3>feedback:</h3>";
    if ($result_feedback->num_rows > 0) {
        while ($row = $result_feedback->fetch_assoc()) {
            echo "<p>feedback_id: " . $row['feedback_id'] . "</p>";
            echo "<p>user_id: " . $row['user_id'] . "</p>";
            echo "<p>workshop_id: " . $row['workshop_id'] . "</p>";
            echo "<p>instructor_id: " . $row['instructor_id'] . "</p>";
            echo "<p>feedback_text: " . $row['feedback_text'] . "</p>";
            echo "<p>rating: " . $row['rating'] . "</p>";
        }
    } else {
        echo "<p>No feedback found matching the search term: " . $searchTerm . "</p>";
    }

 echo "<h3>enrollment:</h3>";
    if ($result_enrollment->num_rows > 0) {
        while ($row = $result_enrollment->fetch_assoc()) {
            echo "<p>enrollment_id: " . $row['enrollment_id'] . "</p>";
            echo "<p>user_id: " . $row['user_id'] . "</p>";
            echo "<p>workshop_id: " . $row['workshop_id'] . "</p>";
            echo "<p>status: " . $row['status'] . "</p>";
        }
    } else {
        echo "<p>No enrollment found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>attendees:</h3>";
    if ($result_attendees->num_rows > 0) {
        while ($row = $result_attendees->fetch_assoc()) {
            echo "<p>attendee_id: " . $row['attendee_id'] . "</p>";
            echo "<p>user_id: " . $row['user_id'] . "</p>";
            echo "<p>workshop_type: " . $row['workshop_type'] . "</p>";
            echo "<p>registration_date: " . $row['registration_date'] . "</p>";
        }
    } else {
        echo "<p>No attendees found matching the search term: " . $searchTerm . "</p>";
    }


    echo "<h3>payments:</h3>";
    if ($result_payment->num_rows > 0) {
        while ($row = $result_payment->fetch_assoc()) {
            echo "<p>payment_id: " . $row['payment_id'] . "</p>";
            echo "<p>user_id: " . $row['user_id'] . "</p>";
            echo "<p>workshop_id: " . $row['workshop_id'] . "</p>";
            echo "<p>amount: " . $row['amount'] . "</p>";
            echo "<p>payment_date: " . $row['payment_date'] . "</p>";
        }
    } else {
        echo "<p>No payments found matching the search term: " . $searchTerm . "</p>";
    }

    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
