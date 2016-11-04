function affichagePersonnage(nomPersonnage) {
    if (nomPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getDonneeByChamp",
                table: "personnage",
                champWhere: "nom",
                valeurWhere: nomPersonnage
            },
            success: function (data) {
                try {
                    var unPersonnage = JSON.parse(data);
                    if (unPersonnage.nom !== undefined && unPersonnage.nom != "") {
                        afficherPersonnage(unPersonnage);
                        affichageNombreMessageMJNonLue(unPersonnage.nom);
                        setTimeout("affichagePersonnage('" + unPersonnage.nom + "')", 5000);
                    }
                } catch (e) {
                    console.error("affichagePersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "affichagePersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery affichagePersonnage (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichagePersonnage (" + nomPersonnage + ")", 0);
            }
        });
    }
}

function affichageNombreMessageMJNonLue(nomPersonnage) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "countMessageMJ",
            valeur: nomPersonnage
        },
        success: function (data) {
            try {
                var nombreMessageNonLue = JSON.parse(data);
                if (nombreMessageNonLue.nombreMessage != "") {
                    afficherNombreMessageNonLue(nombreMessageNonLue.nombreMessage);
                }
            } catch (e) {
                console.error("affichageNombreMessageMJNonLue : " + e + "(" + data + ")");
                afficherMessage(4, "affichageNombreMessageMJNonLue : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery affichageNombreMessageMJNonLue (" + nomPersonnage + ")");
            afficherMessage(4, "erreur sur la fonction JQuery affichageNombreMessageMJNonLue (" + nomPersonnage + ")", 0);
        }
    });
}

function affichageMessages(nomPersonnage) {
    if (nomPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getMessages",
                valeur: nomPersonnage
            },
            success: function (data) {
                try {
                    var lesMessages = JSON.parse(data);
                    if (lesMessages.length != 0 && (lesMessages.length != 1 || (lesMessages[0].id != "" && lesMessages[0].id !== undefined))) {
                        for (i = 0; i < lesMessages.length; i++) {
                            affichageLeMessage(lesMessages[i]);
                        }
                    } else {
                        console.error("affichageMessages : " + e + "(" + data + ")");
                        afficherMessage(4, "affichageMessages : " + e + "(" + data + ")", 0);
                    }
                } catch (e) {
                    console.error("affichageMessages : " + e + "(" + data + ")");
                    afficherMessage(4, "affichageMessages : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery affichageMessages (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichageMessages (" + nomPersonnage + ")", 0);
            }
        });
    }
}

function affichageLeMessage(unMessage) {
    var leMessage = "<div class=\"row clearfix\"><div class=\"col-md-10 column textUnMessage\">" + unMessage.message + "</div><div class=\"col-md-2 column dateUnMessage\">" + convertirDateUSFR(unMessage.dateCreaction) + "</div></div><hr>";
    $("#Corps").append(leMessage);
}

function allMessagesLue(nomPersonnage) {
    if (nomPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "allMessagesLue",
                valeur: nomPersonnage
            },
            success: function (data) {
                if (data != "") {
                    console.error("allMessagesLue : " + e + "(" + data + ")");
                    afficherMessage(4, "allMessagesLue : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery allMessagesLue (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery allMessagesLue (" + nomPersonnage + ")", 0);
            }
        });
    }
}

function afficherNombreMessageNonLue(nombreMessageNonLue) {
    $("#messageNonLue").empty().append(nombreMessageNonLue);
    if (nombreMessageNonLue == 0) {
        $("#messageDuMJ").removeClass("danger").addClass("default");
    } else {
        $("#messageDuMJ").removeClass("default").addClass("danger");
    }
}

function afficherPersonnage(unPersonnage) {
    $("#lvl").empty().append(unPersonnage['lvl']);
    $("#classe").empty().append(unPersonnage['classe']);
    $("#metier").empty().append(unPersonnage['metier']);
    $("#vie").empty().append(unPersonnage['vie']);
    $("#mana").empty().append(unPersonnage['mana']);
    $("#force").empty().append(unPersonnage['force']);
    $("#education").empty().append(unPersonnage['education']);
    $("#dexterite").empty().append(unPersonnage['dexterite']);
    $("#perception").empty().append(unPersonnage['perception']);
    $("#constitution").empty().append(unPersonnage['constitution']);
    $("#charisme").empty().append(unPersonnage['charisme']);
    $("#chance").empty().append(unPersonnage['chance']);
    $("#competence").empty().append(unPersonnage['competence']);
    $("#sort").empty().append(unPersonnage['sort']);
    $("#equipement").empty().append(unPersonnage['equipement']);
    $("#inventaire").empty().append(unPersonnage['inventaire']);
    $("#po").empty().append(unPersonnage['po']);
}

function evenButtonSendMessageMJClick(nomPersonnage, divEvent) {
    if (nomPersonnage != "") {
        $(divEvent).click(function () {
            bootbox.prompt({
                title: "Message au MJ",
                value: "",
                callback: function (result) {
                    if (result !== null) {
                        ajoutMessage(nomPersonnage, result);
                    }
                }
            });
        });
    }
}

function evenInputPersonnageChange(nomPersonnage, divEvent) {
    if (nomPersonnage != "") {
        $(divEvent).change(function () {
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurPersonnage(nomPersonnage, champ, valeur);
        });
    }
}

function modifierValeurPersonnage(nomPersonnage, champ, valeur) {
    if (nomPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "updateValeurDonneeByChamp",
                table: "personnage",
                champ: champ,
                valeur: valeur,
                champWhere: "nom",
                valeurWhere: nomPersonnage
            },
            success: function (data) {
                if (data != "") {
                    console.error("modifierValeurPersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "modifierValeurPersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery modifierValeurPersonnage (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurPersonnage (" + nomPersonnage + ")", 0);
            }
        });
    }
}

function ajoutMessage(nomPersonnage, message) {
    if (nomPersonnage != "") {
        message = message + "<br>by : " + nomPersonnage;

        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addMessage",
                id: 0,
                message: message
            },
            success: function (data) {
                if (data != "") {
                    console.error("ajoutMessage : " + e + "(" + data + ")");
                    afficherMessage(4, "ajoutMessage : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery ajoutMessage (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutMessage (" + nomPersonnage + ")", 0);
            }
        });
    }
}