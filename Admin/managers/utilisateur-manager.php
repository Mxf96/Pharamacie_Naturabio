<?php
require '../../../includes/inc-db-connect.php';

function getAllUsers($dbh)
{
    $sql = "SELECT Utilisateurs.*, Roles.libelle_role 
            FROM Utilisateurs
            LEFT JOIN assigner ON Utilisateurs.id_utilisateur = assigner.id_utilisateur
            LEFT JOIN Roles ON assigner.id_role = Roles.id_role
            ORDER BY Utilisateurs.id_utilisateur ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getUserById($dbh, $id)
{
    $sql = "SELECT Utilisateurs.*, assigner.id_role, Roles.libelle_role 
            FROM Utilisateurs
            LEFT JOIN assigner ON Utilisateurs.id_utilisateur = assigner.id_utilisateur
            LEFT JOIN Roles ON assigner.id_role = Roles.id_role
            WHERE Utilisateurs.id_utilisateur = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertUser($dbh, $nom_utilisateur, $prenom_utilisateur, $email_utilisateur, $hashed_password, $id_role)
{
    $sql = "INSERT INTO utilisateurs (nom_utilisateur, prenom_utilisateur, email_utilisateur, mdp_utilisateur) VALUES (?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_utilisateur, $prenom_utilisateur, $email_utilisateur, $hashed_password]);
    $id_utilisateur = $dbh->lastInsertId();
    $sql = "INSERT INTO assigner (id_utilisateur, id_role) VALUES (?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id_utilisateur, $id_role]);
}

function updateUser($dbh, $id, $nom_utilisateur, $prenom_utilisateur, $email_utilisateur, $id_role)
{
    $sql = "UPDATE utilisateurs SET nom_utilisateur = ?, prenom_utilisateur = ?, email_utilisateur = ? WHERE id_utilisateur = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$nom_utilisateur, $prenom_utilisateur, $email_utilisateur, $id]);
    $sql = "UPDATE assigner SET id_role = ? WHERE id_utilisateur = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id_role, $id]);
}

function deleteUser($dbh, $id)
{
    $sql = "DELETE FROM utilisateurs WHERE id_utilisateur = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
