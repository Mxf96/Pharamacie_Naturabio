<?php
require '../includes/inc-db-connect.php';
require 'categorie-manager.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_categorie = $_GET['id'];
    $categorie = getCategoriesById($dbh, $id_categorie);

    // Ajouter la vérification ici
    if (!$categorie) {
        echo "Erreur: Pas de catégorie correspondante à l'ID fourni.";
        exit;
    }

    $products = getAllProductsFromCategory($dbh, $id_categorie);

    require '../includes/inc-top.php';
?>
    <main>
        <div>
            <a href="/category/index.php" class="back-button">Retour</a>
            <h1 class="h1">Nos produits de la catégorie "<?php echo $categorie['nom_categorie']; ?>"</h1>
        </div>
        <div class="card-container">
            <?php foreach ($products as $product) { ?>
                <div class="card">
                    <a href="/products/ficheProduit.php?id=<?php echo $product['id_produit']; ?>">
                        <div class="image-container">
                            <img class="slide-in-down"  src="/admin/assets/<?php echo $product['url_image']; ?>" alt="Image de <?php echo $product['nom_produit']; ?>">
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
    echo "Erreur: ID de la catégorie non fourni ou invalide.";
}
?>
