<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/marque-manager.php';;
require '../../managers/image-manager.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_marque = sanitize_input($_POST['nom_marque']);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . sanitize_input(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    insertBrand($dbh, $nom_marque);
    $id_marque = $dbh->lastInsertId();

    if ($uploadOk == 1) {
        insertBrandImage($dbh, $target_file, $id_marque);
    }

    header("Location: index.php");
    exit();
}

require '../../includes/inc-top-fm.php';
?>

<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/Products/index.php" class="btn btn-info btn-block">Retour</a>
        <form action="new.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nom de la marque: </label>
                <input type="text" name="nom_marque">
            </div>
            <div class="form-group">
                <label>Logo de la marque: </label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn">Créer</button>
            </div>
    </div>
</form>

<?php
require '../../includes/inc-bottom.php';
?>