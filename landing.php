<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">Task Manager</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron mt-4">
            <h1>Welcome to Your Task Manager</h1>
            <?php
            session_start();
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                echo "<p>You are logged in as " . $_SESSION['username'] . ".</p>";
            } else {
                echo "<p>You are not logged in.</p>";
                exit;
            }
            ?>
        </div>
        <div class="task-container">
            <h2>Stored Tasks:</h2>
            <?php
            include("./db_conn.php");

            // Fetch tasks from the database for the logged-in user
            $user_id = $_SESSION['id'];
            $sql = "SELECT * FROM logbook_entries WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                // Display tasks
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="task">';
                        echo '<h3>Entry Date: ' . htmlspecialchars($row["entry_date"]) . '</h3>';
                        echo '<p>Entry Time: ' . htmlspecialchars($row["entry_time"]) . '</p>';
                        echo '<p>Days: ' . htmlspecialchars($row["days"]) . '</p>';
                        echo '<p>Week: ' . htmlspecialchars($row["week"]) . '</p>';
                        echo '<p>Activity Description: ' . htmlspecialchars($row["activity_description"]) . '</p>';
                        echo '<p>Working Hours: ' . htmlspecialchars($row["working_hours"]) . '</p>';
                        echo '<a class="btn btn-custom btn-sm" href="update_task.php?id=' . $row['id'] . '">Update</a> ';
                        echo '<a class="btn btn-danger btn-sm" href="delete_task.php?id=' . $row['id'] . '">Delete</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p> Oops!! You currently have no Tasks</p>";
                }
                $stmt->close();
            } else {
                echo "Error: Could not prepare statement.";
            }
            $conn->close();
            ?>
        </div>
        <a href="./register_task.html" class="btn btn-primary">Add Task</a>
    </div>
</body>
</html>
