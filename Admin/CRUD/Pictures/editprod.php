<?php
require '../../managers/image-manager.php';
require '../../../includes/inc-db-connect.php';

$id = $_GET['id'];
$image = getImageById($dbh, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["url_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the upload directory is writable
    if (!is_writable($target_dir)) {
        die("The upload directory is not writable!");
    }

    // Check if image file is a real image or fake image
    $check = getimagesize($_FILES["url_image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["url_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // If everything is OK, try to upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["url_image"]["tmp_name"], $target_file)) {
            echo "The file " . sanitize_input(basename($_FILES["url_image"]["name"])) . " has been uploaded.";
            updateProductImage($dbh, $id, $target_file); // Update the image with the full path
            header("Location: index.php");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

require '../../includes/inc-top-fm.php';
?>
<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/Pictures/index.php" class="btn btn-info btn-block">Retour</a>
        <h1 class="h1">Modifier l'image du produit</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="url_image">URL de l'image :</label>
            </div>
            <div class="form-group">
                <input type="file" id="url_image" name="url_image">
            </div>
            <div class="form-group">
                <button type="submit">Mettre à jour</button>
            </div>
    </div>
</form>