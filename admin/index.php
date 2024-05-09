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
        .navbar-brand {
            display: flex;
            align-items: center;
        }
        .navbar-brand h2 {
            margin: 0;
            font-weight: bold;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../icons/logo.jpg" alt="Logo">
        </a>
        <h2 class="text-center mx-auto my-0">ADMIN Dashboard</h2>
    </div>
</nav>


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
