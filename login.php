<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GS</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Set background color */
        }
        .container {
            max-width: 400px; /* Set maximum width for better readability */
        }
        h2 {
            text-align: center; /* Center align the heading */
            margin-bottom: 30px; /* Add margin below the heading */
        }
        label {
            font-weight: bold; /* Make labels bold */
        }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container mt-4">
    <h2>Login</h2>
    <?php
    // Include database connection
    include 'db-connection.php';

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve username and password from form
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Prepare SQL statement to select admin with given username and password
        $stmt = $conn->prepare("SELECT id FROM admin WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        
        // Execute SQL statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a row is returned (i.e., if credentials are correct)
        if ($result->num_rows == 1) {
            // Redirect to admin dashboard
            header("Location: admin/index.php");
            exit();
        } else {
            // Display alert for incorrect credentials
            echo "<div class='alert alert-danger' role='alert'>Incorrect username or password</div>";
        }

        // Close statement
        $stmt->close();
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
</div>

</body>
</html>
