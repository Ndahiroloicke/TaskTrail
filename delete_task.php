<?php
include("./db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Prepare and execute SQL statement to delete the task
    $sql = "DELETE FROM logbook_entries WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $taskId);
        if ($stmt->execute()) {
            echo "<script>alert('Task deleted successfully')</script>";
            header("Location: landing.php");
        } else {
            echo "Error deleting task: " . $stmt->error;
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
