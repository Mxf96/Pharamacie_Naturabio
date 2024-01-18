<?php
require '../../managers/marque-manager.php';;
require '../../../includes/inc-db-connect.php';
$marques = getAllBrands($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>

<div class="header">
    <h1 class="h1">Liste des Marques</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
    <a href="/Admin/CRUD/Brands/new.php" class="create-button">Créer une nouvelle marque</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($marques as $marque) { ?>
            <tr>
                <td><?php echo $marque['id_marque']; ?></td>
                <td><?php echo $marque['nom_marque']; ?></td>
                <td>
                    <a class="update-button" href="edit.php?id=<?php echo $marque['id_marque']; ?>">Modifier</a> |
                    <a class="delete-button" href="delete.php?id=<?php echo $marque['id_marque']; ?>">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>