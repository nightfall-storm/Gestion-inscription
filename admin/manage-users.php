<?php
include "db-connection.php";
include 'auth-session.php';

// Pagination variables
$limit = 15; // Number of users per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page number
$page = max(1, $page); // Ensure page number is not less than 1
$start = ($page - 1) * $limit; // Starting row for fetching users

// Fetch data from the database with pagination
$sql = "SELECT id, nom, prenom, adress, nomPere, nomMere, telephone_personnel, telephone_waliy, picture, valid FROM user LIMIT $start, $limit";
$result = $conn->query($sql);

$total_pages_sql = "SELECT COUNT(*) as total FROM user";
$total_pages_result = $conn->query($total_pages_sql);
$total_rows = $total_pages_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

$search = isset($_GET['search']) ? $_GET['search'] : ''; // Get search term from the form
$whereClause = $search ? "WHERE nom LIKE '%$search%'" : ''; // Add WHERE clause if search term exists
$sqlSearch = "SELECT id, nom, prenom, adress, nomPere, nomMere, telephone_personnel, telephone_waliy, picture, valid FROM user $whereClause LIMIT $start, $limit";
$result = $conn->query($sqlSearch);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        .tableContainer {
            color: #fff; /* Set text color to light */
            margin-left: 380px; /* Add some margin from the left for content */
            margin-right: 280px; /* Add some margin from the right for content */

        }
        .table {
            background-color: rgba(255, 255, 255, 0.15); /* Semi-transparent white background */
        }
        .table th,
        .table td {
            color: #fff; /* Set text color to light */
            border-color: #fff; /* Set border color to light */
        }
        .table th {
            background-color: rgba(255, 255, 255, 0.3); /* Semi-transparent white background for table header */
        }
        .table .action-icons i {
            margin-right: 10px; /* Add space between icons */
        }
        .table-responsive {
    margin-top: 85px; /* Add some margin from the top */
}
.pagination li.page-item a.page-link {
    background-color: #333; /* Dark gray background */
    color: #fff; /* White text color */
    border: 1px solid #fff; /* White border */
}
.pagination li.page-item a.page-link:hover {
    background-color: #555; /* Darker gray background on hover */
}


    </style>
</head>
<body>

<!-- Navbar -->
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

<div class="tableContainer">
    <!-- Table to display user data -->
    <div class="table-responsive">
    <div class="container mt-3">
    <form action="manage-users.php" method="GET" class="form-inline">
        <div class="form-group mr-2">
            <label for="search" class="sr-only">Search by Nom</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Search by Nom">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    </div>
    <table class="table table-striped table-dark">
    <!-- Table headers -->
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Nom du Père</th>
            <th>Nom de la Mère</th>
            <th>Téléphone Personnel</th>
            <th>Téléphone Waliy</th>
            <th>Picture</th>
            <th>Validation</th> <!-- New column for validation -->
            <th>Actions</th>
        </tr>
    </thead>
    <!-- Table body -->
    <tbody>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . $row["prenom"] . "</td>";
            echo "<td>" . $row["adress"] . "</td>";
            echo "<td>" . $row["nomPere"] . "</td>";
            echo "<td>" . $row["nomMere"] . "</td>";
            echo "<td>" . $row["telephone_personnel"] . "</td>";
            echo "<td>" . $row["telephone_waliy"] . "</td>";
            echo "<td><img src='../uploads/" . $row["picture"] . "' alt='User Picture' style='width:50px;height:auto;'></td>";
            echo "<td>";
            if ($row["valid"]) {
                echo "<img src='../icons/yes.png' alt='Yes' style='width: 20px; height: 20px;'>";
            } else {
                echo "<img src='../icons/no.png' alt='No' style='width: 20px; height: 20px;'>";
            }
            echo "</td>";
            echo "<td class='action-icons'>";
            echo "<a href='modify-user.php?id=" . $row['id'] . "'><i class='fas fa-edit'></i></a>";
            echo "<a href='delete-user.php?id=" . $row['id'] . "&page=$page' class='delete-btn' data-id='" . $row['id'] . "'><i class='fas fa-trash'></i></a>";
            echo "</td>"; // Icon for Delete action
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>0 results</td></tr>"; // Adjust colspan for new column
    }
    ?>
</tbody>


</table>

    </div>

    <!-- Pagination links -->
    <div class="pagination justify-content-center">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>

<script>
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default behavior of the link
            const userId = this.getAttribute('data-id');
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = this.getAttribute('href'); // Proceed with the deletion
            }
        });
    });
</script>


<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
