$(document).ready(function(){
    $('.btn-delete').on('click', function() {
        var product_id = $(this).data('id');
        if (confirm('Voulez-vous retirer ce produit de votre liste ?')) {
            $.ajax({
                url: 'remove_from_list.php',
                type: 'post',
                data: {id_produit: product_id},
                success: function(response) {
                    if (response === 'success') {
                        location.reload();
                    } else {
                        alert('Il y a eu une erreur lors de la suppression du produit de votre liste.');
                    }
                }
            });
        }
    });
});
