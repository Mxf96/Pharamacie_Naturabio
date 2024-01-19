<?php
require 'categorie-manager.php';
require '../includes/inc-db-connect.php';
$imagesCategories = getAllImagesCategories($dbh);
require '../includes/inc-top.php';
?>

<main>
    <div>
        <a href="/index.php" class="back-button">Retour</a>
        <h1 class="h1">Nos Categories</h1>
    </div>
    <div class="card-container">
        <?php foreach ($imagesCategories as $imagesCategorie) { ?>
            <div class="card">
                <a href="/category/produitCategorie.php?id=<?php echo $imagesCategorie['id_categorie']; ?>">
                    <div class="image-container">
                        <img class="slide-in-down"  src="/admin/assets/<?php echo $imagesCategorie['url_image']; ?>" alt="Image de <?php echo $imagesCategorie['nom_categorie']; ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title centered">
                            <?php echo $imagesCategorie['nom_categorie']; ?>
                        </h5>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</main>

<?php require '../includes/inc-bottom.php'; ?>