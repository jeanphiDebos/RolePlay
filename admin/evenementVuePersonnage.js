function affichagePersonnage(idPersonnage) {
    if (idPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getDonneeById",
                table: "personnage",
                id: idPersonnage
            },
            success: function (data) {
                try {
                    var unPersonnage = JSON.parse(data);
                    if (unPersonnage.id !== undefined && unPersonnage.id != "") {
                        afficherPersonnage(unPersonnage);
                        evenButtonDeletPersonnageClick(idPersonnage);
                        evenButtonSendMessagePersonnageClick(idPersonnage);
                        evenInputPersonnageChange(idPersonnage);
                    } else {
                        console.error("id affichagePersonnage : " + data);
                    }
                } catch (e) {
                    console.error("affichagePersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "affichagePersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery affichagePersonnage (" + idPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichagePersonnage (" + idPersonnage + ")", 0);
            }
        });
    }
}

function afficherPersonnage(unPersonnage) {
    $("#lvl").val(unPersonnage['lvl']);
    $("#classe").val(unPersonnage['classe']);
    $("#metier").val(unPersonnage['metier']);
    $("#vie").val(unPersonnage['vie']);
    $("#mana").val(unPersonnage['mana']);
    $("#force").val(unPersonnage['force']);
    $("#education").val(unPersonnage['education']);
    $("#dexterite").val(unPersonnage['dexterite']);
    $("#perception").val(unPersonnage['perception']);
    $("#constitution").val(unPersonnage['constitution']);
    $("#charisme").val(unPersonnage['charisme']);
    $("#chance").val(unPersonnage['chance']);
    $("#competence").val(unPersonnage['competence']);
    $("#sort").val(unPersonnage['sort']);
    $("#equipement").val(unPersonnage['equipement']);
    $("#inventaire").val(unPersonnage['inventaire']);
    $("#po").val(unPersonnage['po']);
}

function evenSelectListePersonnageChange(divEven) {
    $(divEven).change(function () {
        var idPerso = $(this).val();
        $(location).attr('href', "./index.php?perso=" + idPerso);
    });
}

function evenButtonAddPersonnageClick(divEven) {
    $(divEven).click(function () {
        bootbox.prompt({
            title: "Nom du nouveau Personnage",
            value: "",
            callback: function (result) {
                if (result == "") {
                    afficherMessage(4, "nom du nouveau personnage vide", 0);
                } else if (result !== null) {
                    ajoutPersonnage(result);
                }
            }
        });
    });
}

function evenButtonDeletPersonnageClick(idPersonnage) {
    if (idPersonnage != "") {
        $("#deletPersonnage").click(function () {
            bootbox.confirm("Are you sure?", function (result) {
                if (result) supprimerTable("personnage", idPersonnage, "./index.php?perso=");
            });
        });
    }
}

function evenButtonSendMessagePersonnageClick(idPersonnage) {
    if (idPersonnage != "") {
        $("#sendMessagePersonnage").click(function () {
            bootbox.prompt({
                title: "Message au joueur",
                value: "",
                callback: function (result) {
                    if (result == "") {
                        afficherMessage(4, "Message au joueur vide", 0);
                    } else if (result !== null) {
                        ajoutMessage(idPersonnage, result);
                    }
                }
            });
        });
    }
}

function evenInputPersonnageChange(idPersonnage) {
    if (idPersonnage != "") {
        $(".inputDescriptionPersonnage").change(function () {
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurTable("personnage", idPersonnage, champ, valeur);
        });
    }
}

function ajoutPersonnage(nomPersonnage) {
    if (nomPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addDonneeByValeur",
                table: "personnage",
                champ: "nom",
                valeur: nomPersonnage
            },
            success: function (data) {
                try {
                    var unPersonnage = JSON.parse(data);
                    $("#listePersonnage").append($("<option></option>").attr("value", unPersonnage.id).attr("class", "unPersonnageOption").text(unPersonnage.nom));
                } catch (e) {
                    console.error("ajoutPersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "ajoutPersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery ajoutPersonnage (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutPersonnage (" + nomPersonnage + ")", 0);
            }
        });
    }
}

function ajoutMessage(idPersonnage, message) {
    if (idPersonnage != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addMessage",
                id: idPersonnage,
                message: message
            },
            success: function (data) {
                if (data != "") {
                    console.error("ajoutMessage : (" + data + ")");
                    afficherMessage(4, "ajoutMessage : (" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery ajoutMessage (" + idPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutMessage (" + idPersonnage + ")", 0);
            }
        });
    }
}