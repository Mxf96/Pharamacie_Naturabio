<?php
require '../../managers/categorie-manager.php';
require '../../../includes/inc-db-connect.php';


if ($_POST) {
    $id_categorie = $_POST['id_categorie'];
    $nom_categorie = sanitize_input($_POST['nom_categorie']);
    $description_categorie = sanitize_input($_POST['description_categorie']);

    if (!empty($nom_categorie)) {
        updateCategory($dbh, $id_categorie, $nom_categorie, $description_categorie);
        header('Location: index.php');
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

$id_categorie = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_categorie !== null) {
    $categorie = getCategoryById($dbh, $id_categorie);

    if ($categorie !== false) {
        require '../../includes/inc-top-fm.php';
?>
        <form method="post">
            <div class="card">
                <a href="/Admin/CRUD/Category/index.php" class="back-button">Retour</a>
                <h1>Modifier la catégorie</h1>
                <input type="hidden" name="id_categorie" value="<?php echo $categorie['id_categorie']; ?>">
                <div class="form-group">
                    <label>Nom de la catégorie: </label>
                    <input type="text" name="nom_categorie" value="<?php echo $categorie['nom_categorie']; ?>">
                </div>
                <div class="form-group">
                    <label>Description de la catégorie: </label>
                    <input type="text" name="description_categorie" value="<?php echo $categorie['description_categorie']; ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" name="submit">Modifier</button>
                </div>
            </div>
        </form>
    <?php

    } else {
        echo "Catégorie non trouvée.";
    }
} else {
    echo "ID de la catégorie non spécifié.";
}
    ?>