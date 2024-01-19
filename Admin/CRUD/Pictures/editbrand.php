<?php
require '../../managers/image-manager.php';
require '../../../includes/inc-db-connect.php';

$id = $_GET['id'];
$image = getImageById($dbh, $id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url_image = $_POST['url_image'];
    updateBrandImage($dbh, $id, $url_image);
    header("Location: index.php");
}

require '../../includes/inc-top-fm.php';
?>
<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/Pictures/index.php" class="back-button">Retour</a>
        <h1 class="h1">Modifier l'image de la marque</h1>
        <div class="form-group">
            <label for="url_image">URL de l'image :</label>
        </div>
        <div class="form-group">
            <input class="select" type="file" id="url_image" name="url_image" value="<?= $image['url_image'] ?>">
        </div>
        <div class="form-group">
            <button class="btn" type="submit">Mettre à jour</button>
        </div>
    </div>
</form>