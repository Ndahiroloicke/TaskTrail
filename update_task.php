<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Task</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="jumbotron mt-4">
            <h1>Update Task</h1>
            <?php
            include("./db_conn.php");

            if (isset($_GET['id'])) {
                $taskId = $_GET['id'];

                // Fetch task data
                $sql = "SELECT * FROM logbook_entries WHERE id = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt) {
                    $stmt->bind_param("i", $taskId);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $task = $result->fetch_assoc();
                    $stmt->close();
                }
            } else {
                echo "Invalid request.";
                exit;
            }
            ?>
            <form action="update_task_action.php" method="POST">
                <input type="hidden" name="taskId" value="<?php echo $task['id']; ?>">
                <div class="form-group">
                    <label for="entry_date">Entry Date:</label>
                    <input type="date" class="form-control" id="entry_date" name="entry_date" value="<?php echo htmlspecialchars($task['entry_date']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="entry_time">Entry Time:</label>
                    <input type="time" class="form-control" id="entry_time" name="entry_time" value="<?php echo htmlspecialchars($task['entry_time']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="days">Days:</label>
                    <input type="text" class="form-control" id="days" name="days" value="<?php echo htmlspecialchars($task['days']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="week">Week:</label>
                    <input type="number" class="form-control" id="week" name="week" value="<?php echo htmlspecialchars($task['week']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="activity_description">Activity Description:</label>
                    <textarea class="form-control" id="activity_description" name="activity_description" rows="3" required><?php echo htmlspecialchars($task['activity_description']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="working_hours">Working Hours:</label>
                    <input type="number" step="0.01" class="form-control" id="working_hours" name="working_hours" value="<?php echo htmlspecialchars($task['working_hours']); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Task</button>
            </form>
            <a href="landing.php" class="btn btn-secondary mt-3">Back to Landing Page</a>
        </div>
    </div>
</body>
</html>
