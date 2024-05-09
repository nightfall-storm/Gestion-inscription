<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<?php include 'navbar.php'; ?>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Inscription</h2>
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
            <button type="submit" class="btn btn-primary btn-block">Signup</button>
        </form>
    </div>
</body>
</html>
