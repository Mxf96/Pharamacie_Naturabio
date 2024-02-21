<?php
session_start();
$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
require 'inc-db-connect.php'
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pharmacie Naturabio</title>
        <link rel="stylesheet" href="/assets/css/styles.css">
        <link rel="stylesheet" href="/assets/css/loginForm.css">
        <link rel="stylesheet" href="/assets/css/registerForm.css">
        <link rel="stylesheet" href="/assets/css/carousel.css">
        <link rel="stylesheet" href="/assets/css/about.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Assurez-vous que le chemin vers autocomplete.js est correct -->
        <script src="/products/autocomplete.js"></script>
    </head>
    
    <body>
        <div class="logo-title">
            <img class="logo" src="/assets/pictures/logo.png" alt="Logo">
            <h1 class="title">Pharmacie Naturabio</h1>
        </div>
        <nav class="navbar">
            <!-- Liens de navigation ici -->
            <a href="/">Accueil</a>
            <a href="/products/index.php">Produits</a>
            <a href="/category/index.php">Catégories</a>
            <a href="/ranges/index.php">Gammes</a>
            <a href="/wishList/maliste.php"><i class="fas fa-shopping-cart"></i></a>
            <a href="/about.php">Contact</a>
            <?php
            if (isset($_SESSION['user_id'])) {
                // Lien de déconnexion si l'utilisateur est connecté
                echo '<a href="/log/logout.php">Déconnexion</a>';
            } else {
                // Lien de connexion si l'utilisateur n'est pas connecté
                echo '<a href="#Se Connecter">Se Connecter</a>';
            }
            ?>
        </nav>
        <!-- login form -->
        <div id="login-modal" class="modal">
            <div class="modal-content-login">
                <span class="close">&times;</span>
                <h2>Se Connecter</h2>
                <form id="login-form" action="/log/login-POST.php" method="POST">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password">
                    <button type="submit">Se connecter</button>
                    <p> Pas encore inscrit ? <a href="#register-link" id="register-link">Créez un compte</a></p>
                </form>
            </div>
        </div>
        <!-- Register form -->
        <div id="register-modal" class="modal">
            <div class="modal-content-register">
                <span class="close">&times;</span>
                <h2>Créer un Compte</h2>
                <form id="register-form" action="/log/register-POST.php" method="POST">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom">
                    <label for="prenom">Prenom :</label>
                    <input type="text" id="prenom" name="prenom">
                    <label for="new-email">Email :</label>
                    <input type="email" id="new-email" name="new-email">
                    <label for="new-password">Mot de passe :</label>
                    <input type="password" id="new-password" name="new-password">
                    <label for="confirm-password">Confirmer le mot de passe :</label>
                    <input type="password" id="confirm-password" name="confirm-password">
                    <button type="submit">S'inscrire</button>
                </form>
            </div>
        </div>