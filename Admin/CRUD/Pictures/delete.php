<?php
require '../../managers/image-manager.php';
require '../../../includes/inc-db-connect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id) {
    deleteImage($dbh, $id);
}

header('Location: index.php');