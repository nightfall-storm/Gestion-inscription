<?php
include "db-connection.php";
include 'auth-session.php';
// Check if user ID is provided
if(isset($_GET['id']) && !empty($_GET['id'] && $_GET['page'])) {
    $userId = $_GET['id'];
    $_SESSION['currentPage'] = $_GET['page'];

    // Prepare and execute the SQL statement to delete the user
    $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // User deleted successfully, redirect back to manage-users.php
        header("Location: manage-users.php?page={$_SESSION['currentPage']}");
        exit();
    } else {
        // Error occurred while deleting user
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If user ID is not provided, redirect back to manage-users.php with an error message
    header("Location: manage-users.php?error=User ID not provided");
    exit();
}
?>
