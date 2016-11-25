function waitEvenAnimationNavire(dateLancementClient) {
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
                        if (evenAnimation.pourQui == "lanceCombatNavire" || evenAnimation.pourQui == "combatNavire"){
                            modifierValeurTable("evenanimation", evenAnimation.id, "jouer", "oui");
                            if (evenAnimation.pourQui == "lanceCombatNavire") getNavires(evenAnimation.animation);
                            else if (evenAnimation.pourQui == "combatNavire") animationCombatNavire(evenAnimation.animation);
                        }
                    });
                }
            } catch (e) {
                console.error("waitEvenAnimationNavire : " + e + "(" + data + ")");
                afficherMessage(4, "waitEvenAnimationNavire : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur waitEvenAnimationNavire");
            afficherMessage(4, "erreur waitEvenAnimationNavire", 0);
        }
    });

    setTimeout("waitEvenAnimationNavire('" + dateLancementClient + "')", 1000);
}

function getNavires(idsNavire){
    var idsNavire = idsNavire.split(";");

    if (idsNavire.length == 2){
        idNavire = idsNavire[0];
        idNavireAdverse = idsNavire[1];
        affichageNavire(idNavire, false);
        affichageNavire(idNavireAdverse, true);
    }
}

function animationCombatNavire(animation){
    if (idNavire != -1 && idNavireAdverse != -1){
        $("#animationCombatNavire").empty().append(animation).removeClass().addClass(animation);
        affichageNavire(idNavire, false);
        affichageNavire(idNavireAdverse, true);
    }
}

function affichageNavire(idNavire, navireAdverse) {
    if (idNavire != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getDonneeById",
                table: "navire",
                id: idNavire
            },
            success: function (data) {
                try {
                    var unNavire = JSON.parse(data);
                    if (unNavire.id !== undefined && unNavire.id != "") {
                        if (!navireAdverse) afficherNavire(unNavire);
                        else afficherNavireAdverse(unNavire);
                    } else {
                        console.error("id affichageNavire : " + data);
                    }
                } catch (e) {
                    console.error("affichageunNavire : " + e + "(" + data + ")");
                    afficherMessage(4, "affichageunNavire : " + e + "(" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery affichageunNavire (" + idNavire + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichageunNavire (" + idNavire + ")", 0);
            }
        });
    }
}

function afficherNavire(unNavire) {
    $("#nom").empty().append(unNavire['nom']);
    $("#image").empty().append("<img class='imageNavire' src='./image/" + unNavire['image'] + "'/>");
    $("#equipage").empty().append(unNavire['equipage']);
    $("#coque").empty().append(unNavire['coque']);
    $("#voile").empty().append(unNavire['voile']);
    $("#canon").empty().append(unNavire['canon']);
    $("#bouletCanon").empty().append(unNavire['bouletCanon']);
}

function afficherNavireAdverse(unNavire) {
    $("#nomAdverse").empty().append(unNavire['nom']);
    $("#imageAdverse").empty().append("<img class='imageNavire' src='./image/" + unNavire['image'] + "'/>");
    $("#equipageAdverse").empty().append(unNavire['equipage']);
    $("#coqueAdverse").empty().append(unNavire['coque']);
    $("#voileAdverse").empty().append(unNavire['voile']);
    $("#canonAdverse").empty().append(unNavire['canon']);
    $("#bouletCanonAdverse").empty().append(unNavire['bouletCanon']);
}