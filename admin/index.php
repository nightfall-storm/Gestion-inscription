<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #333; /* Set background color to dark */
            color: #fff; /* Set text color to light */
        }
        .navbar {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 1000; /* Ensure navbar appears above other content */
        background-color: #222; /* Set navbar background color to darker */
        }
        .navbar-brand img {
            width: 50px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
            margin-right: 10px; /* Add space between logo and text */
        }
        .navbar-nav .nav-link {
            color: #fff; /* Set text color to light */
            font-weight: bold; /* Make text bold */
            margin-right: 20px; /* Add space between menu items */
        }
        .navbar-nav .nav-link:hover {
            color: #007bff; /* Change text color on hover */
        }
        .container {
            color: #fff; /* Set text color to light */
        }
        .alert-primary {
            background-color: #007bff; /* Set alert background color */
            color: #fff; /* Set text color to light */
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #292b2c; /* Darker background color for sidebar */
            padding-top: 100px; /* Space for the top navbar */
        }
        .sidebar-item {
            padding: 10px 20px;
            border-bottom: 1px solid #555; /* Border color */
        }
        .sidebar-item a {
            color: #fff; /* Set text color to light */
            text-decoration: none; /* Remove underline */
            font-weight: bold; /* Make text bold */
        }
        .sidebar-item a:hover {
            color: #007bff; /* Change text color on hover */
        }
    </style>
</head>
<body>
    <?php 
include 'auth-session.php';
    
    ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="../icons/logo.jpg" alt="Logo">
        </a>
        <h2 class="text-center mx-auto my-0">ADMIN Dashboard</h2>
    </div>
</nav>

<!-- Sidebar menu -->
<div class="sidebar">
    <div class="sidebar-item">
        <a href="manage-users.php">Manage Users</a>
    </div>
    <div class="sidebar-item">
        <a href="inscription.php">Add User</a>
    </div>
    <div class="sidebar-item">
        <a href="logout.php">Logout</a>
    </div>
</div>


<div class="container mt-4">
    <!-- Your admin dashboard content goes here -->
    <div class="alert alert-primary" role="alert">
        Welcome to the admin dashboard!
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
