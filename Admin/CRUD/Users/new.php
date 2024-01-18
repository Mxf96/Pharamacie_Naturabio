<?php
require '../../../includes/inc-db-connect.php';
require '../../managers/utilisateur-manager.php';
require '../../managers/role-manager.php';

$roles = getAllRoles($dbh);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = strip_tags(trim(htmlspecialchars($_POST['nom_utilisateur'])));
    $prenom = strip_tags(trim(htmlspecialchars($_POST['prenom_utilisateur'])));
    $email = strip_tags(trim(htmlspecialchars($_POST['email_utilisateur'])));
    $password = strip_tags(trim($_POST['mdp_utilisateur']));
    $passwordConfirm = strip_tags(trim($_POST['confirm_password']));
    $role = intval($_POST['id_role']);

    if ($password !== $passwordConfirm) {
        header("Location: new.php?error=passwordcheck");
        exit();
    }

    $password = password_hash($password, PASSWORD_BCRYPT);

    insertUser($dbh, $nom, $prenom, $email, $password, $role);

    header("Location: index.php");
    exit();
}
require '../../includes/inc-top-fm.php';
?>
<form method="post">
    <div class="card">
        <a href="/Admin/CRUD/Roles/index.php" class="back-button ">Retour</a>
        <h1>Ajouter un nouveau rôle</h1>
        <div class="form-group">
            <label>Nom : </label>
            <input type="text" name="nom_utilisateur" class="form-control">
        </div>
        <div class="form-group">
            <label>Prenom : </label>
            <input type="text" name="prenom_utilisateur" class="form-control">
        </div>
        <div class="form-group">
            <label>E-mail : </label>
            <input type="text" name="email_utilisateur" class="form-control">
        </div>
        <div class="form-group">
            <label>Mot de passe : </label>
            <input type="password" name="mdp_utilisateur" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirmer le mot de passe : </label>
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <div class="form-group">
            <label>Rôle : </label>
            <select name="id_role" class="form-control">
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['id_role'] ?>"><?= $role['libelle_role'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn" name="submit">Connexion</button>
        </div>
    </div>
</form>