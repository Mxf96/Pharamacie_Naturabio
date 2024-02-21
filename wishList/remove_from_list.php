<?php
session_start();

if (isset($_SESSION['id_utilisateur']) && isset($_POST['id_produit'])) {
    require '../includes/inc-db-connect.php';

    $id_utilisateur = $_SESSION['id_utilisateur'];
    $id_product = $_POST['id_produit'];

    $stmt = $dbh->prepare("DELETE inclure FROM inclure 
                           JOIN liste_souhaits ON inclure.id_liste = liste_souhaits.id_liste 
                           WHERE liste_souhaits.id_utilisateur = :id_utilisateur 
                           AND inclure.id_produit = :id_produit");
    $stmt->bindParam(':id_utilisateur', $id_utilisateur);
    $stmt->bindParam(':id_produit', $id_product);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo 'success';
    } else {
        echo 'failure';
    }
} else {
    echo 'failure';
}
?>
