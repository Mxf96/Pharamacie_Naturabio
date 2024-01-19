<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/categorie-manager.php';
require '../../managers/marque-manager.php';
require '../../managers/produit-manager.php';

$id_produit = intval($_GET['id']);
$product = getProductById($dbh, $id_produit);
$categories = getAllCategories($dbh);
$brands = getAllBrands($dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom_produit = $_POST['nom_produit'];
    $description_produit = $_POST['description_produit'];
    $quantite_produit = ($_POST['quantite_produit']);
    $prix_produit = $_POST['prix_produit'];
    $categorie = $_POST['id_categorie'];
    $marque = $_POST['id_marque'];

    // Mise à jour des informations du produit
    updateProduct($dbh, $id_produit, $nom_produit, $description_produit, $prix_produit, $quantite_produit, $categorie, $marque);

    header("Location: index.php");
    exit();
}

require '../../includes/inc-top-fm.php';
?>
<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/produits/index.php" class="btn btn-info btn-block">Retour</a>
        <form action="<?php echo sanitize_input($_SERVER['PHP_SELF'] . "?id=" . $id_produit); ?>" method="post">
            <div class="form-group">
                <label>Nom du produit: </label>
                <input type="text" name="nom_produit" value="<?= $product['nom_produit'] ?>">
            </div>
            <div class="form-group">
                <label>Description du produit: </label>
                <input type="text" name="description_produit" value="<?= $product['description_produit'] ?>">
            </div>
            <div class="form-group">
                <label>Prix du produit: </label>
                <input type="text" name="prix_produit" value="<?= $product['prix_produit'] ?>">
            </div>
            <div class="form-group">
                <label>Quantité du produit: </label>
                <input type="text" name="quantite_produit" value="<?= $product['quantite_produit'] ?>">
            </div>
            <div class="form-group">
                <label>Catégorie du produit: </label>
                <select name="id_categorie">
                    <?php foreach ($categories as $categorie) : ?>
                        <option value="<?= $categorie['id_categorie'] ?>" <?= $categorie['id_categorie'] == $product['id_categorie'] ? 'selected' : '' ?>><?= $categorie['nom_categorie'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label>Marque du produit: </label>
                <select name="id_marque">
                    <?php foreach ($brands as $brand) : ?>
                        <option value="<?= $brand['id_marque'] ?>" <?= $brand['id_marque'] == $product['id_marque'] ? 'selected' : '' ?>><?= $brand['nom_marque'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn">Mettre à jour</button>
            </div>
    </div>
</form>