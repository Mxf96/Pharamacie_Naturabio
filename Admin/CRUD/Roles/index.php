<?php
require '../../managers/role-manager.php';
require '../../../includes/inc-db-connect.php';
$roles = getAllRoles($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>

<div class="header">
    <h1 class="h1">Liste des Rôles</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
    <a href="/Admin/CRUD/Roles/new.php" class="create-button">Créer un nouveau rôle</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom du Rôle</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($roles as $role) { ?>
            <tr>
                <td><?php echo $role['id_role']; ?></td>
                <td><?php echo $role['libelle_role']; ?></td>
                <td>
                    <a class="update-button" href="edit.php?id=<?php echo $role['id_role']; ?>">Modifier</a> |
                    <a class="delete-button" href="delete.php?id=<?php echo $role['id_role']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>