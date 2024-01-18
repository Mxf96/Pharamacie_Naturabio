<?php
require '../../managers/image-manager.php';
require '../../../includes/inc-db-connect.php';
$imagesProduits = getAllImagesProduits($dbh);
$imagesMarque = getAllImagesMarques($dbh);
$imagesCategories = getAllImagesCategories($dbh);
require '../../../Admin/includes/inc-top-tb.php';
?>
<div>
    <h1 class="h1">Liste des Images</h1>
    <a href="/Admin/dashboard.php" class="back-button">Retour</a>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Produit Associé</th>
            <th>Image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($imagesProduits as $imageProduit) { ?>
            <tr>
                <td><?php echo $imageProduit['id_image']; ?></td>
                <td><?php echo $imageProduit['nom_produit']; ?></td>
                <td><img class="slide-in-down" src="/admin/assets/<?php echo $imageProduit['url_image']; ?>" alt="Image de <?php echo $imageProduit['nom_produit']; ?>" style="width: 100px;"></td>
                <td>
                    <a href="editprod.php?id=<?= htmlspecialchars($imageProduit['id_image']); ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $imageProduit['id_image']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Categorie Associée</th>
            <th>Image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($imagesCategories as $imageCategorie) { ?>
            <tr>
                <td><?php echo $imageCategorie['id_image']; ?></td>
                <td><?php echo $imageCategorie['nom_categorie']; ?></td>
                <td><img class="slide-in-down" src="/admin/assets/<?php echo $imageCategorie['url_image']; ?>" alt="Image de <?php echo $imageCategorie['nom_categorie']; ?>" style="width: 100px;"></td>
                <td>
                    <a href="editcateg.php?id=<?= htmlspecialchars($imageCategorie['id_image']); ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $imageCategorie['id_image']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Marque Associée</th>
            <th>Image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($imagesMarque as $imageMarque) { ?>
            <tr>
                <td><?php echo $imageMarque['id_image']; ?></td>
                <td><?php echo $imageMarque['nom_marque']; ?></td>
                <td><img class="slide-in-down" src="/admin/assets/<?php echo $imageMarque['url_image']; ?>" alt="Image de <?php echo $imageMarque['nom_marque']; ?>" style="width: 100px;"></td>
                <td>
                    <a href="editbrand.php?id=<?= htmlspecialchars($imageMarque['id_image']); ?>">Modifier</a>
                    <a href="delete.php?id=<?php echo $imageMarque['id_image']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>