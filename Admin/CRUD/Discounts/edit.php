<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/reduction-manager.php';
require '../../managers/produit-manager.php';

// Récupérer la liste des produits
$produits = getAllProducts($dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_reduction = $_POST['id_reduction'];
    $pourcentage_reduction = intval($_POST['pourcentage_reduction']);
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $produits_selectionnes = isset($_POST['id_produits']) ? $_POST['id_produits'] : [];

    // Mettre à jour la réduction existante
    $id_produit = null;
    if (!empty($produits_selectionnes)) {
        $id_produit = reset($produits_selectionnes); // Récupérer le premier produit sélectionné
    }
    updateReduction($dbh, $id_reduction, $date_debut, $date_fin, $pourcentage_reduction, $id_produit);

    header("Location: index.php");
    exit();
}

$id_reduction = isset($_GET['id']) ? $_GET['id'] : null; // Récupérer l'ID de la réduction à éditer

// Obtenir les détails de la réduction
if ($id_reduction !== null) {
    $reduction = getReductionById($dbh, $id_reduction);

    if ($reduction !== false) {
        require '../../includes/inc-top-fm.php';
?>

        <div class="container">
            <div class="login-box">
                <a href="/Admin/CRUD/Discounts/index.php" class="back-button">Retour</a>
                <h1>Modifier la réduction</h1>
                <form method="post">
                    <input type="hidden" name="id_reduction" value="<?php echo $reduction['id_reduction']; ?>">
                    <div class="form-group">
                        <label>Pourcentage : </label>
                        <input type="number" name="pourcentage_reduction" value="<?php echo $reduction['pourcentage_reduction']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date début : </label>
                        <input type="date" name="date_debut" value="<?php echo $reduction['date_debut']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Date fin : </label>
                        <input type="date" name="date_fin" value="<?php echo $reduction['date_fin']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Produits applicables :</label>
                        <?php foreach ($produits as $produit) { ?>
                            <input type="checkbox" name="id_produits[]" value="<?php echo $produit['id_produit']; ?>" <?php if (in_array($produit['id_produit'], $reduction['id_produits'])) echo 'checked'; ?>>
                            <label><?php echo $produit['nom_produit']; ?></label>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button" name="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
<?php
        require '../../includes/inc-bottom.php';
    } else {
        echo "Réduction non trouvée.";
        exit();
    }
} else {
    echo "ID de la réduction non spécifié.";
    exit();
}
?>