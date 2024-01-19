<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/role-manager.php';
require '../../../Admin/includes/inc-top-tb.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $libelle_role = sanitize_input($_POST['libelle_role']);

    insertRole($dbh, $libelle_role);

    header("Location: index.php");
    exit();
}

require '../../includes/inc-top-fm.php';
?>

<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/roles/index.php" class="btn btn-info btn-block">Retour</a>
        <h1>Ajouter un nouveau rôle</h1>
        <div class="form-group">
            <label>Libellé du rôle : </label>
            <input type="text" name="libelle_role">
        </div>
        <div class="form-group">
            <button type="submit" class="button" name="submit">Ajouter</button>
        </div>
    </div>
</form>