<?php
require '../../managers/categorie-manager.php';
require '../../../includes/inc-db-connect.php';
$categories = getAllCategories($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>
<div>
    <h1 class="h1">Liste des Catégories</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
    <a href="/Admin/CRUD/Category/new.php" class="create-button">Créer une nouvelle catégorie</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($categories as $categorie) { ?>
            <tr>
                <td><?php echo $categorie['id_categorie']; ?></td>
                <td><?php echo $categorie['nom_categorie']; ?></td>
                <td><?php echo $categorie['description_categorie']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $categorie['id_categorie']; ?>">Modifier</a> |
                    <a href="delete.php?id=<?php echo $categorie['id_categorie']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
            </tr>
        <?php } ?>
    </tbody>
</table>