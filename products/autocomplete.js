$(document).ready(function() {
    $("#searchInput").keyup(function() {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: 'search.php',
                method: 'POST',
                data: {
                    query: query
                },
                success: function(data) {
                    $("#output").html(data);
                }
            });
        } else {
            $("#output").html('');
        }
    });
    $(document).on('click', 'li', function() {
        $("#searchInput").val($(this).text());
        $("#output").html('');
    });
});

$(document).ready(function() {
    $("#searchInput").keyup(function() {
        var query = $(this).val();
        if (query != "") {
            $.ajax({
                url: 'search.php', // Votre script côté serveur pour la recherche
                method: 'POST',
                data: {
                    query: query
                },
                success: function(data) {
                    $("#output").html(data);
                    if(data.trim().length > 0) { // Vérifie si des données sont retournées
                        $("#output").css({
                            "border": "5px solid #ccc", // Affiche la bordure
                            "display": "block" // S'assure que #output est visible
                        });
                    } else {
                        $("#output").css({
                            "border": "0 solid #ccc", // Masque la bordure si aucune donnée
                            "display": "none" // Masque #output si aucune donnée
                        });
                    }
                }
            });
        } else {
            $("#output").css({
                "border": "0 solid #ccc", // Masque la bordure si le champ est vide
                "display": "none" // Masque #output si le champ est vide
            });
        }
    });
});