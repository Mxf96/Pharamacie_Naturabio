<?php
require '../../managers/categorie-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    deleteCategory($dbh, $id);
}

header('Location: index.php');