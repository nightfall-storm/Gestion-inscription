<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
        .container {
            color: #fff; /* Set text color to light */
        }
        .insc {
            margin-top: 85px; /* Add margin from the top */
        }
</style>
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="../icons/logo.jpg" alt="Logo">
        </a>
        <h2 class="text-center mx-auto my-0">ADMIN Dashboard</h2>
    </div>
</nav>
<body>
    <!-- Sidebar menu -->
<div class="sidebar">
    <div class="sidebar-item">
        <a href="manage-users.php">Manage Users</a>
    </div>
    <div class="sidebar-item">
        <a href="inscription.php">Add User</a>
    </div>
</div>
    <div class="container mt-5">
        <h2 class="text-center insc">Inscription</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="inscription_process.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" pattern="[A-Za-zÀ-ÿ\s]+" required>
                    </div>
                <div class="form-group">
                    <label for="prenom">Prénom:</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div class="form-group">
                    <label for="adress">Adresse:</label>
                    <input type="text" class="form-control" id="adress" name="adress" required>
                </div>
                <div class="form-group">
                    <label for="nomPere">Nom du Père:</label>
                    <input type="text" class="form-control" id="nomPere" name="nomPere" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div class="form-group">
                    <label for="nomMere">Nom de la Mère:</label>
                    <input type="text" class="form-control" id="nomMere" name="nomMere" pattern="[A-Za-zÀ-ÿ\s]+" required>
                </div>
                <div class="form-group">
                    <label for="telephone_personnel">Téléphone Personnel:</label>
                    <input type="tel" class="form-control" id="telephone_personnel" name="telephone_personnel" pattern="[0-9]+" required>
                </div>
                <div class="form-group">
                    <label for="telephone_waliy">Téléphone Waliy:</label>
                    <input type="tel" class="form-control" id="telephone_waliy" name="telephone_waliy" pattern="[0-9]+" required>
                </div>
                <div class="form-group">
                    <label for="picture">Photo:</label>
                    <input type="file" class="form-control-file" id="picture" name="picture" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="valid">Validation:</label>
                    <input type="checkbox" id="valid" name="valid" value="1">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Signup</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
