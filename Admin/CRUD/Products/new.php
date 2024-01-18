<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/categorie-manager.php';
require '../../managers/marque-manager.php';;
require '../../managers/produit-manager.php';
require '../../managers/image-manager.php';

$categories = getAllCategories($dbh);
$brands = getAllBrands($dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_produit = strip_tags(trim(htmlspecialchars($_POST['nom_produit'])));
    $description_produit = strip_tags(trim(htmlspecialchars($_POST['description_produit'])));
    $prix_produit = floatval($_POST['prix_produit']);
    $quantite_produit = intval($_POST['quantite_produit']);
    $categorie = intval($_POST['id_categorie']);
    $marque = intval($_POST['id_marque']);

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

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
    if (file_exists($target_file)) {
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

    // Vérifie si $uploadOk est défini sur 0 par une erreur
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // si tout va bien, essayez de télécharger le fichier
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    insertProduct($dbh, $nom_produit, $description_produit, $prix_produit, $quantite_produit, $categorie, $marque);
    $id_produit = $dbh->lastInsertId();
    if ($uploadOk == 1) {
        insertProductImage($dbh, $target_file, $id_produit);
    }

    header("Location: index.php");
    exit();
}
require '../../includes/inc-top-fm.php';
?>

<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/produits/index.php" class="btn btn-info btn-block">Retour</a>
        <form action="new.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nom du produit: </label>
                <input type="text" name="nom_produit">
            </div>
            <div class="form-group">
                <label>Description du produit: </label>
                <input type="text" name="description_produit">
            </div>
            <div class="form-group">
                <label>Prix du produit: </label>
                <input type="text" name="prix_produit">
            </div>
            <div class="form-group">
                <label>Quantité du produit: </label>
                <input type="text" name="quantite_produit">
            </div>
            <div class="form-group">
                <label>Catégorie du produit: </label>
                <select name="id_categorie">
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['id_categorie'] ?>"><?= $categorie['nom_categorie'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Marque du produit: </label>
                <select name="id_marque">
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?= $brand['id_marque'] ?>"><?= $brand['nom_marque'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Image du produit: </label>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn">Créer</button>
            </div>
    </div>
</form>