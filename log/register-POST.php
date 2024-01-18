<?php
session_start();
require '../includes/inc-db-connect.php';
require '../log/security-manager.php';


$nom = sanitize_input($_POST['nom']);
$prenom = sanitize_input($_POST['prenom']);
$email = sanitize_input($_POST['new-email']);
$password = $_POST['new-password'];
$confirmPassword = $_POST['confirm-password'];

if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password) && !empty($confirmPassword)) {
    if ($password === $confirmPassword) {
        // Vérifier si l'email est déjà utilisé
        $stmt = $dbh->prepare("SELECT id_utilisateur FROM utilisateurs WHERE email_utilisateur = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            // Email n'est pas déjà utilisé
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Commencer une transaction
            $dbh->beginTransaction();

            try {
                // Insérer l'utilisateur dans la base de données
                $insertStmt = $dbh->prepare("INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (:nom, :prenom, :email, :mdp)");
                $insertStmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $insertStmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
                $insertStmt->bindParam(':mdp', $hashedPassword, PDO::PARAM_STR);
                $insertStmt->execute();

                // Récupérer l'ID de l'utilisateur nouvellement inséré
                $userId = $dbh->lastInsertId();

                // Attribuer le rôle de Client (id_role = 2)
                $roleStmt = $dbh->prepare("INSERT INTO assigner (id_utilisateur, id_role) VALUES (:userId, 2)");
                $roleStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $roleStmt->execute();

                // Valider la transaction
                $dbh->commit();

                // Inscription réussie, redirection vers la page de connexion
                header("Location: /index.php?registration=success");
                exit();
            } catch (Exception $e) {
                // Une erreur s'est produite, annuler la transaction
                $dbh->rollBack();
                header("Location: /index.php?error=registrationfailed");
                exit();
            }
        } else {
            // Email déjà utilisé
            header("Location: /index.php?error=emailtaken");
            exit();
        }
    } else {
        // Les mots de passe ne correspondent pas
        header("Location: /index.php?error=passwordcheck");
        exit();
    }
} else {
    // Champs manquants
    header("Location: /index.php?error=emptyfields");
    exit();
}
