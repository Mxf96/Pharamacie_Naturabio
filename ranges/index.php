<?php
require 'marque-manager.php';
require '../includes/inc-db-connect.php';
$imagesMarques = getAllImagesBrands($dbh);
require '../includes/inc-top.php';
?>

<main>
    <div>
        <a href="/index.php" class="back-button">Retour</a>
        <h1 class="h1">Nos Gammes</h1>
    </div>
    <div class="card-container">
        <?php foreach ($imagesMarques as $imageMarque) { ?>
            <div class="card">
                <a href="/ranges/produitMarque.php?id=<?php echo $imageMarque['id_marque']; ?>">
                    <div class="image-container">
                        <img class="slide-in-down"  src="/admin/assets/<?php echo $imageMarque['url_image']; ?>" alt="Image de <?php echo $imageMarque['nom_marque']; ?>">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title centered">
                            <?php echo $imageMarque['nom_marque']; ?>
                        </h5>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</main>

<?php require '../includes/inc-bottom.php'; ?>