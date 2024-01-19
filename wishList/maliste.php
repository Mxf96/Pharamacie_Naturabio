<?php
require '../includes/inc-db-connect.php';
require '../includes/inc-top.php';

?>

<main>
    <div class="content maliste icone-liste">
        <div class="listeCell">
            <?php
            if (isset($_SESSION['user_id'])) {
                // L'utilisateur est connecté, affichez sa liste
                $id_utilisateur = $_SESSION['user_id'];

                // Obtenir l'id de la liste de souhaits de l'utilisateur
                $stmt = $dbh->prepare("SELECT id_liste FROM liste_souhaits WHERE id_utilisateur = :id_utilisateur");
                $stmt->bindParam(':id_utilisateur', $id_utilisateur);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    $id_liste = $result['id_liste'];

                    // Obtenir les produits dans la liste de souhaits avec les prix
                    $stmt = $dbh->prepare("SELECT produits.id_produit, produits.nom_produit, produits.prix_produit, images.url_image
                       FROM produits 
                       JOIN inclure ON produits.id_produit = inclure.id_produit 
                       JOIN images ON produits.id_produit = images.id_produit 
                       WHERE inclure.id_liste = :id_liste");
                    $stmt->bindParam(':id_liste', $id_liste);
                    $stmt->execute();
                    $favoris = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo '<h1>Ma Liste</h1>';

                    if (count($favoris) > 0) {
                        foreach ($favoris as $item) {
                            echo "<div class='favorisItem'>";
                            echo "<p>$item[nom_produit]</p>";
                            echo "<img class='slide-in-down' src='/admin/assets/" . $item['url_image'] . "' alt='Image de " . $item['nom_produit'] . "'>";
                            echo "<p>Prix : $item[prix_produit]€</p>";
                            echo "<button class='btn-delete' data-id='$item[id_produit]'>Supprimer</button>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Vous n'avez aucun produit dans votre liste.</p>";
                    }
                } else {
                    // Aucune liste de souhaits n'existe pour cet utilisateur
                    echo "<p>Aucune liste de souhaits trouvée pour cet utilisateur.</p>";
                }
            } else {
                // L'utilisateur n'est pas connecté, affichez le bouton de connexion
                echo '<p><a href="#Se Connecter" class="login-trigger">Se connecter pour voir ma liste</a></p>';
            }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/wishlist/list.js"></script>
    <script src="../scripts/scripts.js"></script>
</main>
<?php require '../includes/inc-bottom.php'; ?>