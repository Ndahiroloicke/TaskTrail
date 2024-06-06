<?php
include("./db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['taskId'])) {
    $taskId = $_POST['taskId'];
    $entry_date = $_POST['entry_date'];
    $entry_time = $_POST['entry_time'];
    $days = $_POST['days'];
    $week = $_POST['week'];
    $activity_description = $_POST['activity_description'];
    $working_hours = $_POST['working_hours'];

    // Prepare and execute SQL statement to update the task
    $sql = "UPDATE logbook_entries SET entry_date = ?, entry_time = ?, days = ?, week = ?, activity_description = ?, working_hours = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssissi", $entry_date, $entry_time, $days, $week, $activity_description, $working_hours, $taskId);
        if ($stmt->execute()) {
            echo "<script>alert('Task updated successfully')</script>";
            header("Location: landing.php");
        } else {
            echo "Error updating task: " . $stmt->error;
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

