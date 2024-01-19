<?php
require 'image-manager.php';
require '../includes/inc-db-connect.php';
$imagesProduits = getAllImagesProduct($dbh);
require '../includes/inc-top.php';
?>

<main>
    <div>
        <a href="/index.php" class="back-button">Retour</a>
        <h1 class="h1">Nos Produits</h1>
    </div>
    <div class="card-container">
        <?php foreach ($imagesProduits as $imageProduit) { ?>
            <div class="card">
                <a href="/products/ficheProduit.php?id=<?php echo $imageProduit['id_produit']; ?>">
                    <div class="image-container">
                        <img class="slide-in-down"  src="/admin/assets/<?php echo $imageProduit['url_image']; ?>" alt="Image de <?php echo $imageProduit['nom_produit']; ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title centered">
                            <?php echo $imageProduit['nom_produit']; ?>
                        </h5>
                        <h5 class="card-title right"><?php echo $imageProduit['prix_produit']; ?>€</h5>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</main>

<?php require '../includes/inc-bottom.php'; ?>