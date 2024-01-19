$(document).ready(function() {
    $('#wishlist-form').on('submit', function(e) {
        e.preventDefault();

        // Animation de départ
        $('#add-to-list').addClass('button-loading');

        $.ajax({
            type: 'post',
            url: 'add_to_list.php',
            data: $('#wishlist-form').serialize(),
            success: function() {
                // Animation de fin
                $('#add-to-list').removeClass('button-loading');
                $('#add-to-list').addClass('button-success');
                
                // Afficher le message
                $('#message').text('Votre produit a bien été ajouté à votre liste.');
            },
            error: function() {
                // Animation en cas d'erreur
                $('#add-to-list').removeClass('button-loading');
                $('#add-to-list').addClass('button-error');
            }
        });
    });
});
