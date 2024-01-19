<?php
require '../includes/inc-db-connect.php';
require 'marque-manager.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    $brand = getBrandById($dbh, $id);
    $products = getAllProductsFromBrand($dbh, $id);

    require '../includes/inc-top.php';
?>
    <main>
        <div>
            <a href="/ranges/index.php" class="back-button">Retour</a>
            <h1 class="h1">Nos produits de la gammes "<?php echo $brand['nom_marque']; ?>"</h1>
        </div>
        <div class="card-container">
            <?php foreach ($products as $product) { ?>
                <div class="card slide-in-down">
                    <a href="/products/ficheProduit.php?id=<?php echo $product['id_produit']; ?>">
                        <div class="image-container">
                            <img src="/admin/assets/<?php echo $product['url_image']; ?>" alt="Image de <?php echo $product['nom_produit']; ?>">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title centered">
                                <?php echo $product['nom_produit']; ?>
                            </h5>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </main>


<?php
    require '../includes/inc-bottom.php';
} else {
    echo "Erreur: ID de la marque non fourni ou invalide.";
}
?>