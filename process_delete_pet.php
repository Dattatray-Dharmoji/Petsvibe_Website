<?php
include 'database.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM pets WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p>Pet deleted successfully!</p>";
        echo "<a href='manage_pets.php'>Go Back to Manage Pets</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No pet ID provided!";
    echo "<a href='manage_pets.php'>Go Back to Manage Pets</a>";
}
?>
