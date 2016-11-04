function affichageCarte() {
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "getDonneeByChamp",
            table: "carte",
            champWhere: "afficher",
            valeurWhere: "oui"
        },
        success: function (data) {
            try {
                var uneCarte = JSON.parse(data);
                if (uneCarte.id !== undefined && uneCarte.id != "") {
                    if (idCarte != uneCarte.id) {
                        idCarte = uneCarte.id;

                        $(".masqueCarte").addClass("cacherCaseCarte");
                        $("#carte").empty().append("<img src=\"./image/" + uneCarte.image + "\" id=\"carteEnCour\"><div class=\"masqueCarte\"></div>");
                        $("#carte img").load(function () {
                            redimensionnerCarte();
                        });
                    }

                    if (uneCarte.typeAffichage == "mapper") elementACacher(uneCarte);
                    else if (uneCarte.typeAffichage == "cacher") toutCacher();
                    else if (uneCarte.typeAffichage == "visible") toutAfficher();
                } else {
                    console.error("id affichageCarte : " + uneCarte);
                }

                setTimeout("affichageCarte()", 5000);
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

function elementACacher(uneCarte) {
    if ($(".masqueCarte").attr('id') != uneCarte.axeVertical + "" + uneCarte.axeHorizontal) {
        $(".masqueCarte").empty();
        $(".masqueCarte").attr('id', uneCarte.axeVertical + "" + uneCarte.axeHorizontal);
        for (i = 0; i < uneCarte.axeHorizontal; i++) {
            for (y = 0; y < uneCarte.axeVertical; y++) {
                if (i == uneCarte.axeHorizontal - 1 && y == uneCarte.axeVertical - 1) $(".masqueCarte").append("<div class=\"caseMasqueCarte cacherCaseCarte LastVertical LastHorizontal caseHorizontal" + i + " caseVertical" + y + "\"></div>");
                else if (i == uneCarte.axeHorizontal - 1) $(".masqueCarte").append("<div class=\"caseMasqueCarte cacherCaseCarte LastHorizontal caseHorizontal" + i + " caseVertical" + y + "\"></div>");
                else if (y == uneCarte.axeVertical - 1) $(".masqueCarte").append("<div class=\"caseMasqueCarte cacherCaseCarte LastVertical caseHorizontal" + i + " caseVertical" + y + "\"></div>");
                else $(".masqueCarte").append("<div class=\"caseMasqueCarte cacherCaseCarte caseHorizontal" + i + " caseVertical" + y + "\"></div>");
            }
        }
        $(".caseMasqueCarte").css("width", Math.round(100 / uneCarte.axeVertical) + "%");
        $(".caseMasqueCarte").css("height", Math.round(100 / uneCarte.axeHorizontal) + "%");

        $(".caseMasqueCarte.LastVertical").css("width", (Math.round(100 / uneCarte.axeVertical)) + (100 - (Math.round(100 / uneCarte.axeVertical) * uneCarte.axeVertical)) + "%");
        $(".caseMasqueCarte.LastHorizontal").css("height", (Math.round(100 / uneCarte.axeHorizontal)) + (100 - (Math.round(100 / uneCarte.axeHorizontal) * uneCarte.axeHorizontal)) + "%");
    }

    for (i = 0; i < uneCarte.axeHorizontal; i++) {
        for (y = 0; y < uneCarte.axeVertical; y++) {
            jQuery.ajax({
                type: "GET",
                url: "../model/requeteAJAX.php",
                data: {
                    action: "aCacher",
                    id: uneCarte.id,
                    axeHorizontal: i,
                    axeVertical: y
                },
                success: function (data) {
                    var unaffichage = JSON.parse(data);
                    try {
                        if (unaffichage.aCaher == false) $(".caseHorizontal" + unaffichage.axeHorizontal + ".caseVertical" + unaffichage.axeVertical).removeClass("cacherCaseCarte");
                        else if (unaffichage.aCaher == true) $(".caseHorizontal" + unaffichage.axeHorizontal + ".caseVertical" + unaffichage.axeVertical).addClass("cacherCaseCarte");
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

    $(".masqueCarte").removeClass("cacherCaseCarte");
}

function toutCacher() {
    $(".masqueCarte").empty().addClass("cacherCaseCarte").attr('id', "");
}

function toutAfficher() {
    $(".masqueCarte").empty().removeClass("cacherCaseCarte").attr('id', "");
}

function redimensionnerCarte() {
    $("#carteEnCour").css("max-height", $(window).height() - $("#enTete").height());
    $(".masqueCarte").css("margin", $("#carteEnCour").css("margin")).css("height", $("#carteEnCour").height() + "px").css("width", $("#carteEnCour").width() + "px");
}