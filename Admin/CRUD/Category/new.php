<?php
require '../../managers/categorie-manager.php';
require '../../managers/image-manager.php';
require '../../../includes/inc-db-connect.php';


if ($_POST) {
    $nom_categorie = sanitize_input($_POST['nom_categorie']);
    $description_categorie = sanitize_input($_POST['description_categorie']);

    if (!empty($nom_categorie)) {
        $target_dir = "uploads/";
        $url_image = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($url_image, PATHINFO_EXTENSION));

        // Vérifier si le fichier image est une image réelle ou une image fausse
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Vérifie si le fichier existe déjà
        if (file_exists($url_image)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Vérifier la taille du fichier
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Autoriser certains formats de fichiers
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $url_image)) {
                echo "The file " . sanitize_input(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $id_categorie = insertCategory($dbh, $nom_categorie, $description_categorie);
        if ($uploadOk == 1) {
            inserteCategoryImage($dbh, $url_image, $id_categorie);
        }
        header('Location: index.php');    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

require '../../includes/inc-top-fm.php';
?>

<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/Category/index.php" class="back-button">Retour</a>
        <h1>Ajouter une nouvelle catégorie</h1>
        <form action="new.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nom de la catégorie: </label>
                <input type="text" name="nom_categorie">
            </div>
            <div class="form-group">
                <label>Description de la marque: </label>
                <textarea type="text" name="description_categorie" cols="40" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Image de la catégorie: </label>
                <input class="select" type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <button type="submit" class="btn" name="submit">Ajouter</button>
            </div>
    </div>
</form>