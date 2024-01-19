<?php
require '../../managers/marque-manager.php';
require '../../../includes/inc-db-connect.php';


if ($_POST) {
    $id_marque = $_POST['id_marque'];
    $nom_marque = sanitize_input($_POST['nom_marque']);

    if (!empty($nom_marque)) {
        updateBrand($dbh, $id_marque, $nom_marque);
        header('Location: index.php');
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

$id_marque = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_marque !== null) {
    $marque = getBrandById($dbh, $id_marque);

    if ($marque !== false) {
        require '../../includes/inc-top-fm.php';
?>
        <div class="container">
            <div class="login-box">
                <a href="/Admin/CRUD/Products/index.php" class="btn btn-info btn-block">Retour</a>
                <h1>Modifier la marque</h1>
                <form method="post">
                    <input type="hidden" name="id_marque" value="<?php echo $marque['id_marque']; ?>">
                    <div class="form-group">
                        <label>Nom de la marque: </label>
                        <input type="text" name="nom_marque" value="<?php echo $marque['nom_marque']; ?>">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button" name="submit">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
<?php
        require '../../includes/inc-bottom.php';
    } else {
        echo "Marque non trouvée.";
    }
} else {
    echo "ID de la marque non spécifié.";
}
?>