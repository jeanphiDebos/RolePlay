function affichageImageMonstre(idMonstre, pathUploadFichier) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "listingElementsDossier",
            dossierElement: pathUploadFichier
        },
        success: function (data) {
            try {
                var listeImageCarte = JSON.parse(data);

                for (var i = 0; i < listeImageCarte.length; i++) {
                    $("#imageMonstre").append("<option value='" + listeImageCarte[i] + "' class=\"imageMonstreOption\">" + listeImageCarte[i].substr(0, listeImageCarte[i].indexOf('.')) + "</option>");
                }
            } catch (e) {
                console.error("affichageImageMonstre : " + e + "(" + data + ")");
                afficherMessage(4, "affichageImageMonstre : " + e + "(" + data + ")", 0);
            }

            affichageMonstre(idMonstre);
        },
        error: function () {
            console.error("erreur sur la fonction JQuery affichageImageMonstre");
            afficherMessage(4, "erreur sur la fonction JQuery affichageImageMonstre", 0);
        }
    });
}

function affichageMonstre(idMonstre) {
    if (idMonstre != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getDonneeById",
                table: "bestiaire",
                id: idMonstre
            },
            success: function (data) {
                try {
                    var unMonstre = JSON.parse(data);
                    if (unMonstre.id !== undefined && unMonstre.id != "") {
                        afficherMonstre(unMonstre);
                        evenButtonDeleteMonstreClick(idMonstre);
                        evenButtonCacherMonstreChange(idMonstre);
                        evenInputMonstreChange(idMonstre);
                    } else {
                        console.error("id affichageMonstre : " + data);
                    }
                } catch (e) {
                    console.error("affichageMonstre : " + e + "(" + data + ")");
                    afficherMessage(4, "affichageMonstre : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery affichageMonstre (" + idMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichageMonstre (" + idMonstre + ")", 0);
            }
        });
    }
}

function afficherMonstre(unMonstre) {
    $("#nom").val(unMonstre['nom']);
    $("#imageMonstre option[value='" + unMonstre['image'] + "']").prop('selected', true);
    $("#lvl").val(unMonstre['lvl']);
    $("#vie").val(unMonstre['vie']);
    if (unMonstre['isCacher'] == 1) $("#isCacher").bootstrapSwitch('state', true);
    else $("#isCacher").bootstrapSwitch('state', false);
    $("#attaque").val(unMonstre['attaque']);
    $("#bonusDegat").val(unMonstre['bonusDegat']);
    $("#reductionDegat").val(unMonstre['reductionDegat']);
    $("#sort").val(unMonstre['sort']);
    $("#parade").val(unMonstre['parade']);
    $("#esquive").val(unMonstre['esquive']);
    $("#blocage").val(unMonstre['blocage']);
    $("#contreAttaque").val(unMonstre['contreAttaque']);
    $("#force").val(unMonstre['force']);
    $("#faiblesse").val(unMonstre['faiblesse']);
}

function evenSelectListeMonstreChange(divEvent) {
    $(divEvent).change(function () {
        var idMonstre = $(this).val();
        $(location).attr('href', "./index.php?action=bestiaire&monstre=" + idMonstre);
    });
}

function evenButtonAddMonstreClick(divEvent) {
    $(divEvent).click(function () {
        bootbox.prompt({
            title: "Nom du nouveau Monstre",
            value: "",
            callback: function (result) {
                if (result == "") {
                    console.error("nom du nouveau Monstre vide");
                    afficherMessage(4, "nom du nouveau Monstre vide", 0);
                } else if (result !== null) {
                    ajoutMonstre(result);
                }
            }
        });
    });
}

function evenButtonDeleteMonstreClick(idMonstre) {
    if (idMonstre != "") {
        $("#deletMonstre").click(function () {
            bootbox.confirm("Are you sure?", function (result) {
                if (result) supprimerMonstre(idMonstre);
            });
        });
    }
}

function evenInputMonstreChange(idMonstre) {
    if (idMonstre != "") {
        $(".inputDescriptionMonstre").change(function () {
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurMonstre(idMonstre, champ, valeur);
        });
    }
}

function evenButtonCacherMonstreChange(idMonstre) {
    if (idMonstre != "") {
        $(".inputCacheMonstre").on("switchChange.bootstrapSwitch", function (event, state) {
            var isCacher = 0;
            var stateSwitch = $(this).bootstrapSwitch('state');
            if (stateSwitch) isCacher = 1;

            cacherMonstre(idMonstre, isCacher);
        });
    }
}

function ajoutMonstre(nomMonstre) {
    if (nomMonstre != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addDonneeByValeur",
                table: "bestiaire",
                champ: "nom",
                valeur: nomMonstre
            },
            success: function (data) {
                try {
                    var unMonstre = JSON.parse(data);
                    $("#listeMonstres").append($("<option></option>").attr("value", unMonstre.id).attr("class", "unMonstreOption").text(unMonstre.nom));
                } catch (e) {
                    console.error("ajoutMonstre : " + e + "(" + data + ")");
                    afficherMessage(4, "ajoutMonstre : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery ajoutMonstre (" + nomMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutMonstre (" + nomMonstre + ")", 0);
            }
        });
    }
}

function supprimerMonstre(idMonstre) {
    if (idMonstre != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "deleteDonneeById",
                table: "bestiaire",
                id: idMonstre
            },
            success: function (data) {
                if (data != "") {
                    console.error("supprimerMonstre : (" + data + ")");
                    afficherMessage(4, "supprimerMonstre : (" + data + ")", 0);
                } else {
                    $(location).attr('href', "./index.php?action=bestiaire&monstre=");
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery supprimerMonstre (" + idMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery supprimerMonstre (" + idMonstre + ")", 0);
            }
        });
    }
}

function modifierValeurMonstre(idMonstre, champ, valeur) {
    if (idMonstre != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "updateValeurDonnee",
                table: "bestiaire",
                id: idMonstre,
                champ: champ,
                valeur: valeur
            },
            success: function (data) {
                if (data != "") {
                    console.error("modifierValeurMonstre : (" + data + ")");
                    afficherMessage(4, "modifierValeurMonstre : (" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery modifierValeurMonstre (" + idMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurMonstre (" + idMonstre + ")", 0);
            }
        });
    }
}

function cacherMonstre(idMonstre, isCacher) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "updateValeurDonnee",
            table: "bestiaire",
            id: idMonstre,
            champ: "isCacher",
            valeur: isCacher
        },
        success: function (data) {
            if (data != "") {
                console.error("CacherMonstre : (" + data + ")");
                afficherMessage(4, "CacherMonstre : (" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery cacherMonstre (" + idMonstre + ")");
            afficherMessage(4, "erreur sur la fonction JQuery cacherMonstre (" + idMonstre + ")", 0);
        }
    });
}