<?php
require '../../managers/avis-manager.php';
require '../../../includes/inc-db-connect.php';
$avis = getAllReviews($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>
<div>
    <h1 class="h1">Liste des Avis</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom de l'Utilisateur</th>
            <th>Produit</th>
            <th>Commentaire</th>
            <th>Note</th>
            <th>Date</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($avis as $avis) { ?>
            <tr>
                <td><?php echo $avis['id_avis']; ?></td>
                <td><?php echo $avis['nom_utilisateur']; ?></td>
                <td><?php echo $avis['nom_produit']; ?></td>
                <td><?php echo $avis['commentaire_avis']; ?></td>
                <td><?php echo $avis['note_avis']; ?></td>
                <td><?php echo $avis['date_avis']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $avis['id_avis']; ?>">Modifier</a> |
                    <a href="delete.php?id=<?php echo $avis['id_avis']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>