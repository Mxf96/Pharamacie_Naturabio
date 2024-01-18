<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/reduction-manager.php';
require '../../managers/produit-manager.php';

// Récupérer la liste des produits
$produits = getAllProducts($dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pourcentage_reduction = intval($_POST['pourcentage_reduction']);
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $produits_selectionnes = isset($_POST['produits']) ? $_POST['produits'] : [];

    // Insérer la nouvelle réduction
    $id_produit = null;
    if (!empty($produits_selectionnes)) {
        $id_produit = reset($produits_selectionnes); // Récupérer le premier produit sélectionné
    }
    $id_reduction = insertReduction($dbh, $date_debut, $date_fin, $pourcentage_reduction, $id_produit);

    header("Location: index.php");
    exit();
}

require '../../includes/inc-top-fm.php';
?>

<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/Discounts/index.php" class="btn btn-info btn-block">Retour</a>
        <h1>Ajouter une nouvelle réduction</h1>
        <div class="form-group">
            <label>Pourcentage : </label>
            <input type="number" name="pourcentage_reduction">
        </div>
        <div class="form-group">
            <label>Date début : </label>
            <input type="date" name="date_debut">
        </div>
        <div class="form-group">
            <label>Date fin : </label>
            <input type="date" name="date_fin">
        </div>
        <div class="form-group">
            <label>Produits applicables :</label>
            <?php foreach ($produits as $produit) { ?>
                <input type="checkbox" name="produits[]" value="<?php echo $produit['id_produit']; ?>">
                <label><?php echo $produit['nom_produit']; ?></label>
            <?php } ?>
        </div>
        <div class="form-group">
            <button type="submit" class="button" name="submit">Ajouter</button>
        </div>
    </div>
</form>