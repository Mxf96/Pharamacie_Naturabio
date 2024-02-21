<?php
require 'image-manager.php';
require '../includes/inc-db-connect.php';
require '../includes/inc-top.php';

// Vérifie si l'utilisateur a envoyé une recherche
$searchInput = isset($_GET['search']) ? $_GET['search'] : null;

if ($searchInput) {
    $recherche = "%" . $searchInput . "%";
    $stmtExact = $dbh->prepare("SELECT id_produit FROM produits WHERE nom_produit = ?");
    $stmtExact->execute([$searchInput]);
    $produitExact = $stmtExact->fetch();

    if ($produitExact) {
        header("Location: /products/ficheProduit.php?id=" . $produitExact['id_produit']);
        exit;
    } else {
        $stmt = $dbh->prepare("SELECT * FROM produits JOIN images ON produits.id_produit = images.id_produit WHERE nom_produit LIKE ? OR description_produit LIKE ?");
        $stmt->execute([$recherche, $recherche]);
        $productPictures = $stmt->fetchAll();
    }
} else {
    $productPictures = getAllImagesProduct($dbh);
}
?>

<main>
    <div>
        <a href="/index.php" class="back-button">Retour</a>
        <h1 class="h1">Nos Produits</h1>
        <!-- Formulaire de recherche -->
        <div class="search-container">
            <form action="" method="GET">
                <input type="text" id="searchInput" name="search" placeholder="Rechercher un produit..." required>
                <button type="submit">Rechercher</button>
            </form>
            <div id="output"></div>
        </div>
    </div>
    <div class="card-container">
        <?php if (!empty($productPictures)) : ?>
            <?php foreach ($productPictures as $imageProduit) : ?>
                <div class="card">
                    <a href="/products/ficheProduit.php?id=<?php echo $imageProduit['id_produit']; ?>">
                        <div class="image-container">
                            <img src="/admin/assets/<?php echo isset($imageProduit['url_image']) ? $imageProduit['url_image'] : 'default.jpg'; ?>" alt="Image de <?php echo $imageProduit['nom_produit']; ?>">
                        </div>
                        <div class="card-body">
                            <h5><?php echo $imageProduit['nom_produit']; ?></h5>
                            <h5><?php echo $imageProduit['prix_produit']; ?>€</h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Aucun produit ne correspond à votre recherche.</p>
        <?php endif; ?>
    </div>
</main>

<?php require '../includes/inc-bottom.php'; ?>

</body>

</html>