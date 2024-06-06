<?php
session_start();
include("./db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['user']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);

    // Prepare and bind
    $sql = "SELECT id, username, email, password FROM user_student WHERE username = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $email, $hashed_password);
            $stmt->fetch();

            // Verify the password
            if (password_verify($pass, $hashed_password)) {
                // Set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                header("Location: landing.php");
                exit;
            } else {
                echo "Invalid username, email, or password.";
            }
        } else {
            echo "Invalid username, email, or password.";
        }

        $stmt->close();
    } else {
        echo "Error: Could not prepare statement.";
    }

    $conn->close();
} else {
    header("Location: login.php");
    exit;
}
?>
