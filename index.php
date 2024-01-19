<?php
require 'includes/inc-top.php';
require 'includes/inc-db-connect.php';

// Vérifier si l'utilisateur est connecté et obtenir son prénom
$prenomUtilisateur = isset($_SESSION['prenom_utilisateur']) ? $_SESSION['prenom_utilisateur'] : null;
?>
<section class="main-content">
    <h2>Bienvenue<?php if ($prenomUtilisateur) {
                        echo " " . sanitize_input($prenomUtilisateur);
                    } ?> à la Pharmacie Naturabio</h2>
    <p>Des produits naturels pour votre bien-être et santé.</p>
</section>
<section class="secondary-content">
    <h3>Nos Produits Vedettes</h3>
    <div class="carousel">
        <div class="slides">
            <div class="slide"><img src="/assets/pictures/bg-3.png" alt="Image 1"></div>
            <div class="slide"><img src="/assets/pictures/bg-1.png" alt="Image 2"></div>
            <div class="slide"><img src="/assets/pictures/bg-4.png" alt="Image 3"></div>
        </div>
    </div>
    <p>Lorem ipsum dolor...</p>
</section>
<?php
require 'includes/inc-bottom.php';
?>