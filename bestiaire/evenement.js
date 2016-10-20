function affichageBestiaire(){
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "getBestiaire",
            isCacher: "0"
        },
        success: function(data){
            try{
                listBestiaire = JSON.parse(data);
                for (i = 0; i < listBestiaire.length; i++){
                    afficherUnMonstre(listBestiaire[i]);
                }
            }catch (e){
                console.error("affichageBestiaire : " + e + "(" + data + ")");
                afficherMessage(4, "affichageBestiaire : " + e + "(" + data + ")", 0);
            }
        },
        error: function(){
            console.error("erreur sur la fonction JQuery affichageBestiaire");
            afficherMessage(4, "erreur sur la fonction JQuery affichageBestiaire", 0);
        }
    });
}

function afficherUnMonstre(unMonstre){
    var string = "<div class=\"col-md-12 column\">";
    string += "<div class=\"col-md-3 column\">";
    if (unMonstre.image != "") string += "<img src=\"./image/" + unMonstre.image + "\">";
    string += "</div>";
    string += "<div class=\"col-md-3 column\">nom : " + unMonstre.nom + "</div>";
    string += "<div class=\"col-md-3 column\">lvl : " + unMonstre.lvl + "</div>";
    string += "<div class=\"col-md-3 column\">vie : " + unMonstre.vie + "</div>";
    string += "<div class=\"col-md-3 column\">attaque : " + unMonstre.attaque + "/100</div>";
    string += "<div class=\"col-md-3 column\">bonus Degat : " + unMonstre.bonusDegat + "</div>";
    string += "<div class=\"col-md-3 column\">reduction Degat : " + unMonstre.reductionDegat + "</div>";
    string += "<div class=\"col-md-3 column\">sort : " + unMonstre.sort + "</div>";
    string += "<div class=\"col-md-3 column\">parade : " + unMonstre.parade + "/100</div>";
    string += "<div class=\"col-md-3 column\">esquive : " + unMonstre.esquive + "/100</div>";
    string += "<div class=\"col-md-3 column\">blocage : " + unMonstre.blocage + "/100</div>";
    string += "<div class=\"col-md-3 column\">contre Attaque : " + unMonstre.contreAttaque + "/100</div>";
    string += "<div class=\"col-md-3 column\">contre Attaque : " + unMonstre.force + "</div>";
    string += "<div class=\"col-md-3 column\">contre Attaque : " + unMonstre.faiblesse + "</div>";
    string += "<div class=\"col-md-12 column\"><hr></div>";
    string += "</div>";
    $("#listeBestiaire").append(string);
}