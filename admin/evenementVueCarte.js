function affichageCarte(idCarte) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "getCarteID",
            idCarte: idCarte
        },
        success: function (data) {
            try {
                var uneCarte = JSON.parse(data);
                if (uneCarte.id !== undefined && uneCarte.id != "") {
                    afficherCarte(uneCarte);
                    afficherAxe(uneCarte);
                    afficherTypeAffichage(uneCarte);
                    afficherActiverAfficher(uneCarte);
                } else {
                    console.error("id affichageCarte : " + uneCarte.id);
                }
            } catch (e) {
                console.error("affichageCarte : " + e + "(" + data + ")");
                afficherMessage(4, "affichageCarte : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery affichageCarte");
            afficherMessage(4, "erreur sur la fonction JQuery affichageCarte", 0);
        }
    });
}

function evenButtonAddCarteClick(pathUploadFichier) {
    $("#addCarte").click(function () {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "listingElementsDossier",
                dossierElement: pathUploadFichier
            },
            success: function (data) {
                try {
                    var optionForImageCarte = "";
                    var listeImageCarte = JSON.parse(data);

                    for (var i = 0; i < listeImageCarte.length; i++) {
                        optionForImageCarte += "<option value='" + listeImageCarte[i] + "'>" + listeImageCarte[i].substr(0, listeImageCarte[i].indexOf(".")) + "</option>";
                    }

                    bootbox.dialog({
                        title: "ajouter une carte",
                        message: "<div class=\"row\"><div class=\"col-md-12 column\"><div class=\"input-group\"><span class=\"input-group-addon\">nom de la Carte</span><input type=\"text\" class=\"form-control\" id=\"nomCarte\"></div></div><hr><div class=\"col-md-12 column\"><div class=\"input-group\"><span class=\"input-group-addon\">image de la carte</span><select class=\"form-control\" id=\"imageCarte\">" + optionForImageCarte + "</select></div></div></div>",
                        buttons: {
                            success: {
                                label: "ajouter",
                                className: "btn-success",
                                callback: function () {
                                    var nomCarte = $('#nomCarte').val();
                                    var imageCarte = $('#imageCarte').find(":selected").val();
                                    if (nomCarte != "" && imageCarte != "") {
                                        ajouterUneCarte(nomCarte, imageCarte);
                                    } else {
                                        afficherMessage(4, "nom de la carte ou image de la carte vide", 0);
                                    }
                                }
                            }
                        }
                    });
                } catch (e) {
                    console.error("evenButtonAddCarteClick : " + e + "(" + data + ")");
                    afficherMessage(4, "evenButtonAddCarteClick : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery evenButtonAddCarteClick");
                afficherMessage(4, "erreur sur la fonction JQuery evenButtonAddCarteClick", 0);
            }
        });
    });
}

function evenSelectCarteChange() {
    $("#listeCarte").change(function () {
        var idCarte = $(this).val();
        $(location).attr('href', "./index.php?action=carte&carte=" + idCarte);
    });
}

function evenDivCaseMasqueCarteClick(uneCarte) {
    $(".caseMasqueCarte").click(function () {
        var donnees = $(this).attr('id').split("~");
        var action = donnees[0];
        var axeHorizontal = donnees[1];
        var axeVertical = donnees[2];

        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: action,
                idCarte: uneCarte.id,
                axeHorizontal: axeHorizontal,
                axeVertical: axeVertical
            },
            success: function (data) {
                if (data == "cacher") {
                    $(".caseHorizontal" + axeHorizontal + ".caseVertical" + axeVertical).removeClass("caseCarteAfficher").addClass("caseCarteCacher").attr("id", "afficherCase~" + axeHorizontal + "~" + axeVertical)
                } else if (data == "afficher") {
                    $(".caseHorizontal" + axeHorizontal + ".caseVertical" + axeVertical).removeClass("caseCarteCacher").addClass("caseCarteAfficher").attr("id", "cacherCase~" + axeHorizontal + "~" + axeVertical)
                } else {
                    console.error("evenDivCaseMasqueCarteClick : " + e + "(" + data + ")");
                    afficherMessage(4, "evenDivCaseMasqueCarteClick : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery evenDivCaseMasqueCarteClick");
                afficherMessage(4, "erreur sur la fonction JQuery evenDivCaseMasqueCarteClick", 0);
            }
        });
    });
}

function evenInputAxeVerticalChange(uneCarte) {
    $("#axeVertical").change(function () {
        var axeVertical = $(this).val();
        if (axeVertical != "" && !isNaN(Number(axeVertical))) {
            jQuery.ajax({
                type: "GET",
                url: "../model/requeteAJAX.php",
                data: {
                    action: "modifierAxeVertical",
                    idCarte: uneCarte.id,
                    axeVertical: axeVertical
                },
                success: function (data) {
                    if (data == "") {
                        uneCarte.axeVertical = axeVertical;
                        afficherCarte(uneCarte);
                    } else {
                        console.error("evenInputAxeVerticalChange : " + e + "(" + data + ")");
                        afficherMessage(4, "evenInputAxeVerticalChange : " + e + "(" + data + ")", 0);
                    }
                },
                error: function () {
                    console.error("erreur sur la fonction JQuery evenInputAxeVerticalChange");
                    afficherMessage(4, "erreur sur la fonction JQuery evenInputAxeVerticalChange", 0);
                }
            });
        } else {
            console.error("erreur sur la fonction evenInputAxeHorizontalChange, axeHorizontal n'est pas un entier");
        }
    });
}

function evenInputAxeHorizontalChange(uneCarte) {
    $("#axeHorizontal").change(function () {
        var axeHorizontal = $(this).val();
        if (axeHorizontal != "" && !isNaN(Number(axeHorizontal))) {
            jQuery.ajax({
                type: "GET",
                url: "../model/requeteAJAX.php",
                data: {
                    action: "modifierAxeHorizontal",
                    idCarte: uneCarte.id,
                    axeHorizontal: axeHorizontal
                },
                success: function (data) {
                    if (data == "") {
                        uneCarte.axeHorizontal = axeHorizontal;
                        afficherCarte(uneCarte);
                    } else {
                        console.error("evenInputAxeHorizontalChange : " + e + "(" + data + ")");
                        afficherMessage(4, "evenInputAxeHorizontalChange : " + e + "(" + data + ")", 0);
                    }
                },
                error: function () {
                    console.error("erreur sur la fonction JQuery evenInputAxeHorizontalChange");
                    afficherMessage(4, "erreur sur la fonction JQuery evenInputAxeHorizontalChange", 0);
                }
            });
        } else {
            console.error("erreur sur la fonction evenInputAxeHorizontalChange, axeHorizontal n'est pas un entier");
        }
    });
}

function evenInputTypeAffichageChange(uneCarte) {
    $("#typeAffichage").change(function () {
        var typeAffichage = $(this).val();
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "modifierTypeAffichage",
                idCarte: uneCarte.id,
                typeAffichage: typeAffichage
            },
            success: function (data) {
                if (data != "") {
                    console.error("evenInputTypeAffichageChange : " + e + "(" + data + ")");
                    afficherMessage(4, "evenInputTypeAffichageChange : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery evenInputTypeAffichageChange");
                afficherMessage(4, "erreur sur la fonction JQuery evenInputTypeAffichageChange", 0);
            }
        });
    });
}

function evenInputActiverAfficherChange(uneCarte) {
    $("#activerAfficher").on("switchChange.bootstrapSwitch", function (event, state) {
        var stateSwitch = $(this).bootstrapSwitch('state');
        if (stateSwitch) {
            jQuery.ajax({
                type: "GET",
                url: "../model/requeteAJAX.php",
                data: {
                    action: "afficherCarte",
                    idCarte: uneCarte.id
                },
                success: function (data) {
                    if (data != "") {
                        console.error("evenInputActiverAfficherChange : " + e + "(" + data + ")");
                        afficherMessage(4, "evenInputActiverAfficherChange : " + e + "(" + data + ")", 0);
                    }
                },
                error: function () {
                    console.error("erreur sur la fonction JQuery evenInputActiverAfficherChange");
                    afficherMessage(4, "erreur sur la fonction JQuery evenInputActiverAfficherChange", 0);
                }
            });
        } else {
            jQuery.ajax({
                type: "GET",
                url: "../model/requeteAJAX.php",
                data: {
                    action: "notAfficherCarte",
                },
                success: function (data) {
                    if (data != "") {
                        console.error("evenInputActiverAfficherChange : " + e + "(" + data + ")");
                        afficherMessage(4, "evenInputActiverAfficherChange : " + e + "(" + data + ")", 0);
                    }
                },
                error: function () {
                    console.error("erreur sur la fonction JQuery evenInputActiverAfficherChange");
                    afficherMessage(4, "erreur sur la fonction JQuery evenInputActiverAfficherChange", 0);
                }
            });
        }
    });
}

function afficherCarte(uneCarte) {
    $("#carte").empty().append("<img src=\"../carte/image/" + uneCarte.image + "\" id=\"carteEnCour\"><div class=\"masqueCarte\"></div>");
    $("#carte img").load(function(){
        redimensionnerCarte();
    });

    $(".masqueCarte").empty();
    for (i = 0; i < uneCarte.axeHorizontal; i++) {
        for (y = 0; y < uneCarte.axeVertical; y++) {
            if (i == uneCarte.axeHorizontal - 1 && y == uneCarte.axeVertical - 1) $(".masqueCarte").append("<div class=\"caseMasqueCarte LastVertical LastHorizontal caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            else if (i == uneCarte.axeHorizontal - 1) $(".masqueCarte").append("<div class=\"caseMasqueCarte LastHorizontal caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            else if (y == uneCarte.axeVertical - 1) $(".masqueCarte").append("<div class=\"caseMasqueCarte LastVertical caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            else $(".masqueCarte").append("<div class=\"caseMasqueCarte caseHorizontal" + i + " caseVertical" + y + "\"></div>");
        }
    }

    $(".caseMasqueCarte").css("width", Math.round(100 / uneCarte.axeVertical) + "%");
    $(".caseMasqueCarte").css("height", Math.round(100 / uneCarte.axeHorizontal) + "%");
    $(".caseMasqueCarte.LastVertical").css("width", (Math.round(100 / uneCarte.axeVertical)) + (100 - (Math.round(100 / uneCarte.axeVertical) * uneCarte.axeVertical)) + "%");
    $(".caseMasqueCarte.LastHorizontal").css("height", (Math.round(100 / uneCarte.axeHorizontal)) + (100 - (Math.round(100 / uneCarte.axeHorizontal) * uneCarte.axeHorizontal)) + "%");

    for (i = 0; i < uneCarte.axeHorizontal; i++) {
        for (y = 0; y < uneCarte.axeVertical; y++) {
            jQuery.ajax({
                type: "GET",
                url: "../model/requeteAJAX.php",
                data: {
                    action: "aCacher",
                    idCarte: uneCarte.id,
                    axeHorizontal: i,
                    axeVertical: y
                },
                success: function (data) {
                    var unAffichage = JSON.parse(data);
                    try {
                        if (unAffichage.aCaher == false) $(".caseHorizontal" + unAffichage.axeHorizontal + ".caseVertical" + unAffichage.axeVertical).addClass("caseCarteAfficher").attr("id", "cacherCase~" + unAffichage.axeHorizontal + "~" + unAffichage.axeVertical);
                        if (unAffichage.aCaher == true) $(".caseHorizontal" + unAffichage.axeHorizontal + ".caseVertical" + unAffichage.axeVertical).addClass("caseCarteCacher").attr("id", "afficherCase~" + unAffichage.axeHorizontal + "~" + unAffichage.axeVertical);
                    } catch (e) {
                        console.error("elementACacher : " + e + "(" + data + ")");
                        afficherMessage(4, "elementACacher : " + e + "(" + data + ")", 0);
                    }
                },
                error: function () {
                    console.error("erreur sur la fonction JQuery elementACacher");
                    afficherMessage(4, "erreur sur la fonction JQuery elementACacher", 0);
                }
            });
        }
    }

    evenDivCaseMasqueCarteClick(uneCarte);
}

function afficherAxe(uneCarte) {
    $("#axeVertical").val(uneCarte.axeVertical);
    $("#axeHorizontal").val(uneCarte.axeHorizontal);
    evenInputAxeVerticalChange(uneCarte);
    evenInputAxeHorizontalChange(uneCarte);
}

function afficherTypeAffichage(uneCarte) {
    $("#" + uneCarte.typeAffichage).attr("selected", "selected");
    evenInputTypeAffichageChange(uneCarte);
}

function afficherActiverAfficher(uneCarte) {
    if (uneCarte.afficher == "oui") $("#activerAfficher").bootstrapSwitch('state', true);
    else $("#activerAfficher").bootstrapSwitch('state', false);
    evenInputActiverAfficherChange(uneCarte);
}

function ajouterUneCarte(nomCarte, imageCarte) {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "addCarte",
            nomCarte: nomCarte,
            imageCarte: imageCarte
        },
        success: function (data) {
            try {
                var newCarte = JSON.parse(data);
                if (newCarte.id !== newCarte && newCarte.id != "") {
                    $("#listeCarte").append($("<option></option>").attr("value", newCarte.id).attr("class", "uneCarteOption").text(newCarte.nom));
                } else {
                    console.error("id ajouterUneCarte : " + newCarte.id);
                }
            } catch (e) {
                console.error("ajouterUneCarte : " + e + "(" + data + ")");
                afficherMessage(4, "ajouterUneCarte : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery ajouterUneCarte");
            afficherMessage(4, "erreur sur la fonction JQuery ajouterUneCarte", 0);
        }
    });
}

function redimensionnerCarte() {
    $("#carteEnCour").css("max-height", $(window).height() - $("#enTete").height() - $(".listeAction").height());
    $(".masqueCarte").css("margin", $("#carteEnCour").css("margin")).css("height", $("#carteEnCour").height() + "px").css("width", $("#carteEnCour").width() + "px");
}