<?php
require '../../managers/utilisateur-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$user = getUserById($dbh, $id);

$query = $dbh->query("SELECT * FROM roles");
$roles = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_POST) {
    $prenom_utilisateur = strip_tags(trim($_POST['prenom_utilisateur']));
    $nom_utilisateur = strip_tags(trim($_POST['nom_utilisateur']));
    $email_utilisateur = filter_input(INPUT_POST, 'email_utilisateur', FILTER_VALIDATE_EMAIL);
    $id_role = filter_input(INPUT_POST, 'id_role', FILTER_VALIDATE_INT);

    if ($email_utilisateur) {
        updateUser($dbh, $id, $prenom_utilisateur, $nom_utilisateur, $email_utilisateur, $id_role);
        header('Location: index.php');    } else {
        echo "Format de l'email invalide.";
    }
}

require '../../includes/inc-top-fm.php';
?>
<form method="post">
    <div class="card">
        <a href="/Admin/cruds/utilisateurs/index.php" class="btn btn-info btn-block">Retour</a>
        <h1>Modifier l'utilisateur</h1>
        <form method="post">
            <label> Nom: </label>
            <input type="text" name="nom_utilisateur" value="<?php echo htmlspecialchars($user['nom_utilisateur']); ?>">
            <label>Prenom: </label>
            <input type="text" name="prenom_utilisateur" value="<?php echo htmlspecialchars($user['prenom_utilisateur']); ?>">
            <label> E-mail: </label>
            <input type="text" name="email_utilisateur" value="<?php echo htmlspecialchars($user['email_utilisateur']); ?>">
            <label>Rôle: </label>
            <select name="id_role">
                <?php foreach ($roles as $role) : ?>
                    <option value="<?= $role['id_role'] ?>" <?php if ($role['id_role'] == $user['id_role']) echo 'selected'; ?>>
                        <?= $role['libelle_role'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="form-group">
                <button type="submit" name="submit">Mettre à jour</button>
            </div>
    </div>
</form>