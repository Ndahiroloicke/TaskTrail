<?php
include("db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['user']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Prepare and bind
    $sql = "INSERT INTO user_student (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful');</script>";
            header("Location: login.html");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: Could not prepare statement.";
    }

    $conn->close();
} else {
    header("Location: login.html");
    exit;
}
?>
