<?php
require '../../../includes/inc-db-connect.php';

function getAllRoles($dbh)
{
    $sql = "SELECT * FROM roles ORDER BY id_role ASC";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getRoleById($dbh, $id)
{
    $sql = "SELECT * FROM roles WHERE id_role = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function insertRole($dbh, $libelle_role)
{
    $sql = "INSERT INTO roles (libelle_role) VALUES (?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$libelle_role]);
}

function updateRole($dbh, $id, $libelle_role)
{
    $sql = "UPDATE roles SET libelle_role = ? WHERE id_role = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$libelle_role, $id]);
}

function deleteRole($dbh, $id)
{
    $sql = "DELETE FROM roles WHERE id_role = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$id]);
}
