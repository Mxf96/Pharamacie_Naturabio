<?php
session_start();

if (isset($_SESSION['id_utilisateur'])) {
    require '../includes/inc-db-connect.php';

    $id_product = isset($_POST['id_produit']) ? $_POST['id_produit'] : null;

    if ($id_product) {
        $id_utilisateur = $_SESSION['id_utilisateur'];

        // Vérifier si l'utilisateur a déjà une liste de favoris
        $stmt = $dbh->prepare("SELECT id_liste FROM liste_souhaits WHERE id_utilisateur = :id_utilisateur");
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $id_liste = $result['id_liste'];
        } else {
            // Créer une nouvelle liste de favoris pour l'utilisateur
            $stmt = $dbh->prepare("INSERT INTO liste_souhaits (id_utilisateur) VALUES (:id_utilisateur)");
            $stmt->bindParam(':id_utilisateur', $id_utilisateur);
            $stmt->execute();
            $id_liste = $dbh->lastInsertId();
        }

        // Ajouter le produit à la liste des favoris
        $stmt = $dbh->prepare("INSERT INTO inclure (id_produit, id_liste) VALUES (:id_produit, :id_liste)");
        $stmt->bindParam(':id_produit', $id_product);
        $stmt->bindParam(':id_liste', $id_liste);
        $stmt->execute();

        echo 'Le produit a été ajouté à votre liste de favoris.';
    } else {
        echo 'ID du produit manquant.';
    }
} else {
    echo 'Vous devez être connecté pour ajouter un produit à votre liste de favoris.';
}
?>
