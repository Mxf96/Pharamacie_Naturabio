<?php
require 'includes/inc-top.php';
require 'includes/inc-db-connect.php';
require 'index-manager.php';

// Vérifier si l'utilisateur est connecté et obtenir son prénom
$prenomUtilisateur = isset($_SESSION['prenom_utilisateur']) ? $_SESSION['prenom_utilisateur'] : null;

// Appel à la fonction pour récupérer les images des produits
$imagesProduits = getAllproductPictures($dbh);
?>
<section class="main-content">
    <h2>Bienvenue<?php if ($prenomUtilisateur) { echo " " . sanitize_input($prenomUtilisateur); } ?> à la Pharmacie Naturabio</h2>
    <p>Des produits naturels pour votre bien-être et santé.</p>
</section>
<section class="secondary-content">
    <h3>Nos Produits Vedettes</h3>
    <div class="carousel">
        <div class="slides">
            <?php foreach ($imagesProduits as $image): ?>
                <div class="slide">
                    <img src="/Admin/assets/<?php echo htmlspecialchars($image['url_image']); ?>" alt="Produit: <?php echo htmlspecialchars($image['nom_produit']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
require 'includes/inc-bottom.php';
?>