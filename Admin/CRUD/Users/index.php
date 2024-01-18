<?php
require '../../managers/utilisateur-manager.php';
require '../../../includes/inc-db-connect.php';
$users = getAllUsers($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>

<div class="header">
    <h1 class="h1">Liste des Utilisateurs</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
    <a href="/Admin/CRUD/Users/new.php" class="create-button">Créer un nouvelle utilisateur</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>E-mail</th>
            <th>Rôle</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id_utilisateur']); ?></td>
                <td><?php echo htmlspecialchars($user['prenom_utilisateur']); ?></td>
                <td><?php echo htmlspecialchars($user['nom_utilisateur']); ?></td>
                <td><?php echo htmlspecialchars($user['email_utilisateur']); ?></td>
                <td><?php echo htmlspecialchars($user['libelle_role']); ?></td>
                <td>
                    <a class="update-button" class="update-button" href="edit.php?id=<?php echo htmlspecialchars($user['id_utilisateur']); ?>">Modifier</a> |
                    <a class="delete-button" class="delete-button" href="delete.php?id=<?= htmlspecialchars($user['id_utilisateur']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>