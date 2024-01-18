<?php
session_start();
require '../includes/inc-db-connect.php';
require '../log/security-manager.php';

$email = sanitize_input($_POST['email']);
$password = sanitize_input($_POST['password']);

if (!empty($email) && !empty($password)) {
    // Préparation de la requête SQL pour chercher l'utilisateur et son rôle
    $stmt = $dbh->prepare("SELECT utilisateurs.*, assigner.id_role FROM utilisateurs 
                           INNER JOIN assigner ON utilisateurs.id_utilisateur = assigner.id_utilisateur 
                           WHERE email_utilisateur = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);

    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if (password_verify($password, $user['mdp_utilisateur'])) {
            // Création de la session utilisateur
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['user_email'] = $user['email_utilisateur'];

            // Redirection basée sur le rôle de l'utilisateur
            if ($user['id_role'] == 1) {
                header("Location: /Admin/dashboard.php");
            } elseif ($user['id_role'] == 2) {
                header("Location: /index.php");
            } else {
                header("Location: /index.php?error=invalidrole");
                exit();
            }
        } else {
            // Mot de passe incorrect
            header('Location: /index.php?error=invalidpassword');
        }
    } else {
        // Utilisateur non trouvé
        header('Location: /index.php?error=nouser');
    }
} else {
    // Champs manquants
    header('Location: /index.php?error=emptyfields');
}
