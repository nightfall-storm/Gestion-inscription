<?php
include "db-connection.php";
include 'auth-session.php';

// Check if ID parameter is set
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch user data from the database
    $sql = "SELECT * FROM user WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // User found, fetch data
        $user = $result->fetch_assoc();
    } else {
        // User not found, redirect to manage-users.php
        header("Location: manage-users.php");
        exit();
    }
} else {
    // ID parameter not set, redirect to manage-users.php
    header("Location: manage-users.php");
    exit();
}

// Check if form is submitted
if(isset($_POST['submit'])) {
    // retrieve data
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adress = $_POST['adress'];
    $nomPere = $_POST['nomPere'];
    $nomMere = $_POST['nomMere'];
    $telephone_personnel = $_POST['telephone_personnel'];
    $telephone_waliy = $_POST['telephone_waliy'];
    
    // Check if a file has been uploaded
    if(isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        // File uploaded, proceed with updating user data
        $picture = $_FILES['picture']['name']; // Original filename
        $extension = pathinfo($picture, PATHINFO_EXTENSION); // Extract file extension
        $unique_name = uniqid('user_pic_') . '.' . $extension; // Generate unique filename

        // Move uploaded file to uploads directory with unique name
        $target_dir = "../uploads/";
        $target_file = $target_dir . $unique_name;
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            // Update user data in the database with the unique picture filename
            $sql = "UPDATE user SET nom=?, prenom=?, adress=?, nomPere=?, nomMere=?, telephone_personnel=?, telephone_waliy=?, picture=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssssi", $nom, $prenom, $adress, $nomPere, $nomMere, $telephone_personnel, $telephone_waliy, $unique_name, $id);
            
            if ($stmt->execute()) {
                echo "<script>alert('User data updated successfully');</script>";
                // Handle validation checkbox separately
                $valid = isset($_POST['valid']) ? 1 : 0;

                // Update validation status in the database
                $sql = "UPDATE user SET valid=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $valid, $id);

                if ($stmt->execute()) {
                    echo "<script>alert('Validation status updated successfully');</script>";
                } else {
                    echo "<script>alert('Error updating validation status: " . $conn->error . "');</script>";
                }

                echo "Valid: $valid";

                }
                header("Location: manage-users.php"); // Redirect back to manage-users.php
                exit();
            } else {
                echo "<script>alert('Error updating user data: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Error moving uploaded file: " . $_FILES["picture"]["error"] . "');</script>";
        }
        
    } else {
        // File not uploaded, display error message or take appropriate action
        echo "<script>alert('Please select an image');</script>";
    }



// Close database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify User</title>
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
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #292b2c; /* Darker background color for sidebar */
            padding-top: 70px; /* Space for the top navbar */
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
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

<div class="container mt-5">
    <h2 class="text-center mb-4">Modify User</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom:</label>
            <input type="text" class="form-control" id="nom" name="nom" pattern="[A-Za-zÀ-ÿ\s]+" required value="<?php echo $user['nom']; ?>">
        </div>
        <div class="form-group">
            <label for="prenom">Prénom:</label>
            <input type="text" class="form-control" id="prenom" name="prenom" pattern="[A-Za-zÀ-ÿ\s]+" required value="<?php echo $user['prenom']; ?>">
        </div>
        <div class="form-group">
            <label for="adress">Adresse:</label>
            <input type="text" class="form-control" id="adress" name="adress" required value="<?php echo $user['adress']; ?>">
        </div>
        <div class="form-group">
            <label for="nomPere">Nom du Père:</label>
            <input type="text" class="form-control" id="nomPere" name="nomPere" pattern="[A-Za-zÀ-ÿ\s]+" required value="<?php echo $user['nomPere']; ?>">
        </div>
        <div class="form-group">
            <label for="nomMere">Nom de la Mère:</label>
            <input type="text" class="form-control" id="nomMere" name="nomMere" pattern="[A-Za-zÀ-ÿ\s]+" required value="<?php echo $user['nomMere']; ?>">
        </div>
        <div class="form-group">
            <label for="telephone_personnel">Téléphone Personnel:</label>
            <input type="tel" class="form-control" id="telephone_personnel" name="telephone_personnel" pattern="[0-9]+" required value="<?php echo $user['telephone_personnel']; ?>">
        </div>
        <div class="form-group">
            <label for="telephone_waliy">Téléphone Waliy:</label>
            <input type="tel" class="form-control" id="telephone_waliy" name="telephone_waliy" pattern="[0-9]+" required value="<?php echo $user['telephone_waliy']; ?>">
        </div>
        <div class="form-group">
            <label for="picture">Photo:</label>
            <input type="file" class="form-control-file" id="picture" name="picture" accept="image/*">
        </div>

        <div class="form-group">
            <label for="valid">Validation:</label>
            <input type="checkbox" id="valid" name="valid" <?php if(isset($user['valid']) && $user['valid'] == 'true') echo 'checked'; ?>>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="manage-users.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
