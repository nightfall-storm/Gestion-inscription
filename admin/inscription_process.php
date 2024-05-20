<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <?php
include 'auth-session.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include "db-connection.php";

        // Prepare and bind parameters
        $stmt = $conn->prepare("INSERT INTO user (nom, prenom, adress, nomPere, nomMere, telephone_personnel, telephone_waliy, picture, valid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssi", $nom, $prenom, $adress, $nomPere, $nomMere, $telephone_personnel, $telephone_waliy, $picture, $valid);

        // Set parameters
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $adress = $_POST["adress"];
        $nomPere = $_POST["nomPere"];
        $nomMere = $_POST["nomMere"];
        $telephone_personnel = $_POST["telephone_personnel"];
        $telephone_waliy = $_POST["telephone_waliy"];
        
        // Check if the validation checkbox is checked
        $valid = isset($_POST['valid']) ? 1 : 0;

        // Upload picture
        $target_dir = "../uploads/";
        $extension = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));
        $picture = uniqid('img_') . '.' . $extension;
        $target_file = $target_dir . $picture;
        move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file);

        // Execute prepared statement
        if ($stmt->execute()) {
            echo "<h2>Signup Successful!</h2>";
            echo "<p>Your Inscription has been completed successfully.</p>";
            // Redirect after 3 seconds
            header("refresh:3;url=index.php");
            exit(); // Ensure no further output is sent
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
    ?>

    </div>
</body>
</html>
