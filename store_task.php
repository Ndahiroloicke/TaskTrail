<?php
session_start();
include("./db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $days = $_POST['days'];
    $week = $_POST['week'];
    $activity_description = $_POST['activity_description'];
    $working_hours = $_POST['working_hours'];
    $user_id = $_SESSION['id']; // Get the logged-in user ID from the session

    // Prepare and execute SQL statement to insert the task
    $sql = "INSERT INTO logbook_entries (entry_date, entry_time, days, week, activity_description, working_hours, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssissi", $entry_date, $entry_time, $days, $week, $activity_description, $working_hours, $user_id);
        if ($stmt->execute()) {
            echo "<script>alert('Task registered successfully')</script>";
            header("Location: landing.php");
            exit;
        } else {
            echo "Error registering task: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare statement.";
    }
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
