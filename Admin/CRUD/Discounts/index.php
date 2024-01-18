<?php
require '../../managers/reduction-manager.php';
require '../../../includes/inc-db-connect.php';
$reductions = getAllReductions($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>
<div>
    <h1 class="h1">Liste des Réductions</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
    <a href="/Admin/CRUD/Discounts/new.php" class="create-button">Créer une nouvelle réduction</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Pourcentage de la Réduction</th>
            <th>Date début</th>
            <th>Date fin</th>
            <th>Produit Applicable</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reductions as $reduction) { ?>
            <tr>
                <td><?php echo $reduction['id_reduction']; ?></td>
                <td><?php echo $reduction['pourcentage_reduction']; ?>%</td>
                <td><?php echo $reduction['date_debut']; ?></td>
                <td><?php echo $reduction['date_fin']; ?></td>
                <td><?php echo $reduction['nom_produit']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $reduction['id_reduction']; ?>">Modifier</a> |
                    <a href="delete.php?id=<?php echo $reduction['id_reduction']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>