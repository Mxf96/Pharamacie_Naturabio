<?php
require 'image-manager.php';
require '../includes/inc-db-connect.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if ($id) {
    $product = getProductById($dbh, $id);
    if ($product) {
        require '../includes/inc-top.php';
?>

<main>
    <div>
        <a href="javascript:history.back()" class="back-button">Retour</a>
    </div>
    <div class="product-container">
        <div class="product-image">
            <img class="animated-image" src="/admin/assets/<?php echo $product['url_image']; ?>" alt="Image de <?php echo $product['nom_produit']; ?>">
        </div>
        <div class="product-details">
            <h2><?php echo $product['nom_produit']; ?></h2>
            <h3><?php echo $product['nom_categorie'];?>/<?php echo $product['nom_marque']; ?></h3>
            <h3><?php echo $product['description_produit']; ?></h3>
            <h3><?php echo $product['quantite_produit']; ?></h3>
            <?php if (isset($_SESSION['id_utilisateur'])) : ?>
                <form id="wishlist-form" action="add_to_list.php" method="post">
                    <input type="hidden" name="id_produit" value="<?php echo $product['id_produit']; ?>">
                    <button id="add-to-list" type="submit" class="add-to-list">Ajouter à la liste</button>
                    <span id="message"></span>
                </form>
                <h4>Prix : <?php echo $product['prix_produit']; ?>€</h4>
            <?php else : ?>
                <p><a href="#Se Connecter" class="login-trigger">Veuillez vous connecter pour ajouter ce produit à votre liste de favoris.</a></p>
                <h4>Prix : <?php echo $product['prix_produit']; ?>€</h4>
            <?php endif; ?>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/products/main.js"></script>
<script src="../scripts/scripts.js"></script>
<?php
        require '../includes/inc-bottom.php';
    } else {
        echo 'Produit non trouvé';
    }
} else {
    echo 'Aucun identifiant de produit fourni';
}
?>
