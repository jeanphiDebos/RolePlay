function eventUploadFichier(div, classOption) {
    $("#uploadFichier #file").change(function () {

        jQuery.ajax({
            type: "POST",
            url: "../model/ajaxPhpFile.php",
            data: new FormData($("#uploadFichier")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                try {
                    var fichierUpload = JSON.parse(data);

                    $(div).append("<option value='" + fichierUpload + "' class=\"" + classOption + "\">" + fichierUpload.substr(0, fichierUpload.indexOf('.')) + "</option>");
                } catch (e) {
                    console.error("uploadFichier : " + e + "(" + data + ")");
                    afficherMessage(4, "uploadFichier : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery uploadFichier");
                afficherMessage(4, "erreur sur la fonction JQuery uploadFichier", 0);
            }
        });
    });
}

function insertEventAnimation(animation, pourQui){
    if (animation != "" && pourQui != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "insertAnimation",
                animation: animation,
                pourQui: pourQui
            },
            success: function (data) {
                if (data != "") {
                    console.error("insertEventAnimation : (" + data + ")");
                    afficherMessage(4, "insertEventAnimation : (" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery insertEventAnimation (" + animation + ", " + pourQui + ")");
                afficherMessage(4, "erreur sur la fonction JQuery insertEventAnimation (" + animation + ", " + pourQui + ")", 0);
            }
        });
    }
}

function modifierValeurTable(table, id, champ, valeur) {
    if (id != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "updateValeurDonnee",
                table: table,
                id: id,
                champ: champ,
                valeur: valeur
            },
            success: function (data) {
                if (data != "") {
                    console.error("modifierValeurTable : (" + data + ")");
                    afficherMessage(4, "modifierValeurTable : (" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery modifierValeurTable (" + table + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurTable (" + table + ")", 0);
            }
        });
    }
}

function modifierValeurTableByChamp(table, champWhere, valeurWhere, champ, valeur) {
    if (valeurWhere != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "updateValeurDonneeByChamp",
                table: table,
                champ: champ,
                valeur: valeur,
                champWhere: champWhere,
                valeurWhere: valeurWhere
            },
            success: function (data) {
                if (data != "") {
                    console.error("modifierValeurTableByChamp : (" + data + ")");
                    afficherMessage(4, "modifierValeurTableByChamp : (" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery modifierValeurTableByChamp (" + valeurWhere + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurTableByChamp (" + valeurWhere + ")", 0);
            }
        });
    }
}

function supprimerTable(table, id, localisation) {
    if (id != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "deleteDonneeById",
                table: table,
                id: id
            },
            success: function (data) {
                if (data != "") {
                    console.error("supprimerTable : (" + data + ")");
                    afficherMessage(4, "supprimerTable : (" + data + ")", 0);
                } else {
                    $(location).attr('href', localisation);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery supprimerTable (" + id + ")");
                afficherMessage(4, "erreur sur la fonction JQuery supprimerTable (" + id + ")", 0);
            }
        });
    }
}

function verifJouerSon(nomPersonnage, dateLancementClient, idSession) {
    if (nomPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "doitjouerSon",
                valeur: nomPersonnage,
                dateLancementClient: dateLancementClient,
                idSession: idSession
            },
            success: function (data) {
                try {
                    var son = JSON.parse(data);
                    if (son != "" && son.search("erreur") == -1) {
                        console.log(son);
                        $("#son").attr("src", "../admin/son/" + son);
                        $("#son")[0].play();
                    } else if (son != "" && son.search("erreur:") != 0) {
                        console.error("erreur verifJouerSon: (" + son + ")");
                        afficherMessage(4, "erreur verifJouerSon: (" + son + ")", 0);
                    }
                } catch (e) {
                    console.error("verifJouerSon : " + e + "(" + data + ")");
                    afficherMessage(4, "verifJouerSon : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur verifJouerSon");
                afficherMessage(4, "erreur verifJouerSon", 0);
            }
        });

        setTimeout("verifJouerSon('" + nomPersonnage + "','" + dateLancementClient + "','" + idSession + "')", 1000);
    }
}

function verifEventAnimation(dateLancementClient) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "getEvenAnimation",
            dateLancementClient: dateLancementClient
        },
        success: function (data) {
            try {
                var evenAnimations = JSON.parse(data);
                if (evenAnimations.length && evenAnimations[0].id !== undefined && evenAnimations[0].id != "") {
                    $.each(evenAnimations, function(i, evenAnimation) {
                        if (evenAnimation.pourQui == "lanceCombatNavire"){
                            modifierValeurTable("evenanimation", evenAnimation.id, "jouer", "oui");
                            $(location).attr('href', "../navire/index.php?idsNavire=" + evenAnimation.animation);
                        }
                    });
                }
            } catch (e) {
                console.error("verifEventAnimation : " + e + "(" + data + ")");
                afficherMessage(4, "verifEventAnimation : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur waitEvenAnimationNavire");
            afficherMessage(4, "erreur verifEventAnimation", 0);
        }
    });

    setTimeout("verifEventAnimation('" + dateLancementClient + "')", 1000);
}

function convertirDateUSFR(dateUS) {
    dateUS = dateUS.split(' ');

    var dateValeur = dateUS[0].split('-');
    var heureValeur = dateUS[1];

    if (dateValeur.length == 3) {
        var jour = dateValeur[2];
        var mois = dateValeur[1];
        var annee = dateValeur[0];
        return heureValeur + " " + jour + "/" + mois + "/" + annee;
    } else {
        return "NoValidDate";
    }
}

function dateNow() {
    var dateNow = new Date();
    var jour = dateNow.getDate();
    var mois = dateNow.getMonth();
    var annee = dateNow.getFullYear();

    var heure = dateNow.getHours();
    var minute = dateNow.getMinutes();
    var seconde = dateNow.getSeconds();

    if (jour.toString().length == 1) jour = "0" + jour.toString();
    mois = parseInt(mois) + 1;
    if (mois.toString().length == 1) mois = "0" + mois.toString();
    if (heure.toString().length == 1) heure = "0" + heure.toString();
    if (minute.toString().length == 1) minute = "0" + minute.toString();
    if (seconde.toString().length == 1) seconde = "0" + seconde.toString();

    return annee + "-" + mois + "-" + jour + " " + heure + ":" + minute + ":" + seconde;
}