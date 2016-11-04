function affichageBestiaire() {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "getDonneesByChamp",
            table: "bestiaire",
            champWhere: "isCacher",
            valeurWhere: "0",
            order: " ORDER BY `nom` ASC",
        },
        success: function (data) {
            try {
                var listBestiaire = JSON.parse(data);
                for (i = 0; i < listBestiaire.length; i++) {
                    afficherUnMonstre(listBestiaire[i]);
                }
            } catch (e) {
                console.error("affichageBestiaire : " + e + "(" + data + ")");
                afficherMessage(4, "affichageBestiaire : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery affichageBestiaire");
            afficherMessage(4, "erreur sur la fonction JQuery affichageBestiaire", 0);
        }
    });
}

function afficherUnMonstre(unMonstre) {
    var string = "<div class=\"col-md-12 column\">";
    string += "<div class=\"col-md-3 column\">";
    if (unMonstre.image != "") string += "<img src=\"./image/" + unMonstre.image + "\">";
    string += "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-nom\">" + unMonstre.nom + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-lvl\">" + unMonstre.lvl + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-vie\">" + unMonstre.vie + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-attaque\">" + unMonstre.attaque + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-bonusDegat\">" + unMonstre.bonusDegat + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-reductionDegat\">" + unMonstre.reductionDegat + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-sort\">" + unMonstre.sort + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-parade\">" + unMonstre.parade + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-esquive\">" + unMonstre.esquive + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-blocage\">" + unMonstre.blocage + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-contreAttaque\">" + unMonstre.contreAttaque + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-force\">" + unMonstre.force + "</div>";
    string += "<div class=\"col-md-3 column glyphicon glyphicon-faiblesse\">" + unMonstre.faiblesse + "</div>";
    string += "<div class=\"col-md-12 column\"><hr></div>";
    string += "</div>";
    $("#listeBestiaire").append(string);
}