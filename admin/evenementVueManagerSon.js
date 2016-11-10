function affichageListeSon(pathUploadFichier) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "listingElementsDossier",
            dossierElement: pathUploadFichier
        },
        success: function (data) {
            try {
                var listeSon = JSON.parse(data);

                for (var i = 0; i < listeSon.length; i++) {
                    $("#CheminFichierSon").append("<option value='" + listeSon[i] + "' class=\"sonOption\">" + listeSon[i].substr(0, listeSon[i].indexOf('.')) + "</option>");
                }
            } catch (e) {
                console.error("affichageListeSon : " + e + "(" + data + ")");
                afficherMessage(4, "affichageListeSon : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery affichageListeSon");
            afficherMessage(4, "erreur sur la fonction JQuery affichageListeSon", 0);
        }
    });
}

function evenButtonPlaySonClick() {
    $("#playSon").click(
        function () {
            if ($("#CheminFichierSon").val() != "") {
                jQuery.ajax({
                    type: "GET",
                    url: "../model/requeteAJAX.php",
                    data: {
                        action: "jouerSon",
                        cheminSon: $("#CheminFichierSon").val(),
                        id: $("#listePersonnage").val()
                    },
                    success: function (data) {
                        if (data != "") {
                            console.error("erreur evenButtonPlaySonClick: (" + data + ")");
                            afficherMessage(4, "evenButtonPlaySonClick : (" + data + ")", 0);
                        }
                    },
                    error: function () {
                        console.error("erreur evenButtonPlaySonClick");
                        afficherMessage(4, "erreur sur la fonction JQuery evenButtonPlaySonClick", 0);
                    }
                });
            }
        });
}