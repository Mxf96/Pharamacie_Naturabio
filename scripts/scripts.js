document.addEventListener('DOMContentLoaded', function () {
    // Obtenir le modal et le bouton qui ouvre le modal
    let modal = document.getElementById("login-modal");
    let btn = document.querySelector(".navbar a[href='#Se Connecter']");

    // Obtenir l'élément <span> qui ferme le modal
    let span = document.getElementsByClassName("close")[0];

    // Ouvrir le modal lorsque l'utilisateur clique sur le bouton
    btn.onclick = function () {
        modal.style.display = "block";
    };

    // Fermer le modal lorsque l'utilisateur clique sur × (le span)
    span.onclick = function () {
        modal.style.display = "none";
    };

    // Fermer le modal lorsque l'utilisateur clique en dehors du modal
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // Vérifier la présence de paramètres d'erreur dans l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const loginError = urlParams.get('error');

    if (loginError) {
        modal.style.display = "block";
        // Affichez ici un message d'erreur selon la valeur de loginError
        // Par exemple, vous pouvez ajouter un élément HTML pour le message d'erreur dans le modal
        let errorMessage = document.getElementById('login-error-message');
        if (loginError === 'invalidpassword') {
            errorMessage.textContent = 'Mot de passe incorrect.';
        } else if (loginError === 'nouser') {
            errorMessage.textContent = 'Utilisateur inconnu.';
        }
    }
});


/* register form */
document.addEventListener('DOMContentLoaded', function () {
    let loginModal = document.getElementById("login-modal");
    let registerModal = document.getElementById("register-modal");

    let loginBtn = document.querySelector(".navbar a[href='#Se Connecter']");
    let registerLink = document.querySelector("#login-form a[href='#register-link']"); // Sélecteur mis à jour

    let closeButtons = document.getElementsByClassName("close");

    // Gestionnaire pour le bouton "Se Connecter"
    loginBtn.onclick = function () {
        loginModal.style.display = "block";
    }

    // Gestionnaire pour le lien "Créez un compte"
    registerLink.onclick = function (event) {
        event.preventDefault(); // Empêche le comportement par défaut du lien
        loginModal.style.display = "none";
        registerModal.style.display = "block";
    }

    // Gestionnaire pour les boutons de fermeture
    Array.from(closeButtons).forEach(function (button) {
        button.onclick = function () {
            this.parentElement.parentElement.style.display = "none";
        }
    });

    // Gestionnaire pour les clics hors des modaux
    window.onclick = function (event) {
        if (event.target == loginModal || event.target == registerModal) {
            event.target.style.display = "none";
        }
    }
});