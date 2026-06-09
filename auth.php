<?php
session_start();

include 'database.php'; // Include the database connection
// If logout is requested, destroy the session and redirect to index.php
if (isset($_GET['logout'])) {
    session_destroy();  // Destroy the session
    header("Location: index.php");  // Redirect to index.php
    exit;  // Ensure the script stops execution
}


if (isset($_POST['login'])) {
    $username = trim($_POST['username']);  // Clean input to remove any extra spaces
    $password = trim($_POST['password']);  // Clean input

    // Query to fetch user credentials from the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();  // Fetch the user record

    // Check if user exists and if the plain text password matches
    if ($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id']; // Set session
        header("Location: dashboard.php");  // Redirect to dashboard
        exit;
    } else {
        echo "<script>alert('Invalid credentials'); window.location.href = 'dashboard.php';</script>";
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>
