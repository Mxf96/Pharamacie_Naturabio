<?php
require '../../managers/produit-manager.php';
require '../../../includes/inc-db-connect.php';

$produits = getAllProducts($dbh);

require '../../../Admin/includes/inc-top-tb.php';
?>

<div class="header">
    <h1 class="h1">Liste des Produits</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
    <a href="/Admin/CRUD/Products/new.php" class="create-button">Créer un nouveau produit</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Marque</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produits as $produit) : ?>
            <tr>
                <td><?= sanitize_input($produit['id_produit']); ?></td>
                <td><?= sanitize_input($produit['nom_produit']); ?></td>
                <td><?= sanitize_input($produit['nom_categorie']); ?></td>
                <td><?= sanitize_input($produit['nom_marque']); ?></td>
                <td><?= sanitize_input($produit['description_produit']); ?></td>
                <td><?= sanitize_input($produit['prix_produit']); ?></td>
                <td><?= sanitize_input($produit['quantite_produit']); ?></td>
                <td>
                    <a class="update-button" href="edit.php?id=<?= sanitize_input($produit['id_produit']); ?>">Modifier</a> |
                    <a class="delete-button" href="delete.php?id=<?= sanitize_input($produit['id_produit']); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>