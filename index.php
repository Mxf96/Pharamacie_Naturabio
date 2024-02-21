<?php
require 'includes/inc-top.php';
require 'includes/inc-db-connect.php';
require 'manager/index-manager.php';
require 'log/security-manager.php';
require 'manager/user-manager.php';

// Vérifier si l'utilisateur est connecté et obtenir son ID
$idUtilisateur = isset($_SESSION['id_utilisateur']) ? $_SESSION['id_utilisateur'] : null; // Utiliser 'id_utilisateur'

$prenomUtilisateur = null;
if ($idUtilisateur) {
    // Récupérer les détails de l'utilisateur par ID
    $detailsUtilisateur = getUserById($dbh, $idUtilisateur);
    $prenomUtilisateur = $detailsUtilisateur ? $detailsUtilisateur['prenom_utilisateur'] : null;
}

// Appel à la fonction pour récupérer les images des produits
$imagesProduits = getAllproductPictures($dbh);
?>
<section class="main-content">
    <h2>Bienvenue <?php echo $prenomUtilisateur ? htmlspecialchars($prenomUtilisateur) : ''; ?> à la Pharmacie Naturabio</h2>
    <p>Des produits naturels pour votre bien-être et santé.</p>
</section>
<section class="secondary-content">
    <h3>Nos Produits Vedettes</h3>
    <div class="carousel">
        <div class="slides">
            <?php foreach ($imagesProduits as $image): ?>
                <div class="slide">
                    <img src="/Admin/assets/<?php echo sanitize_input($image['url_image']); ?>" alt="Produit: <?php echo sanitize_input($image['nom_produit']); ?>">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
require 'includes/inc-bottom.php';
?>