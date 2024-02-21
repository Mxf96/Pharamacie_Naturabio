<?php
require_once 'vendor/autoload.php';

// Charger les variables d'environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Construction du DSN à partir des variables d'environnement
$dsn = 'mysql:dbname=' . $_ENV['DB_NAME'] . ';host=' . $_ENV['DB_HOST'] . ';charset=utf8mb4';
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASS'];

// Établissement de la connexion à la base de données
$dbh = new PDO($dsn, $user, $password);