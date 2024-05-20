<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GS</title>
    <!-- Bootstrap CSS -->
    <style>

    </style>
</head>
<body>
<?php include 'navbar.php';
session_start();
if (isset($_SESSION['admin_id'])) {
    // Redirect to admin dashboard
    header("Location: admin/index.php");
    exit();
}
?>


    <!-- Your main content goes here -->


</body>
</html>
