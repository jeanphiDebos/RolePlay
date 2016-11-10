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
    $("#equipage").val(unNavire['equipage']);
    $("#coque").val(unNavire['coque']);
    $("#voile").val(unNavire['voile']);
    $("#canon").val(unNavire['canon']);
    $("#bouletCanon").val(unNavire['bouletCanon']);

    evenInputNavireChange(unNavire['id'], ".inputCaracteristiqueNavire");
}

function afficherNavireAdverse(unNavire) {
    $("#equipageAdverse").val(unNavire['equipage']);
    $("#coqueAdverse").val(unNavire['coque']);
    $("#voileAdverse").val(unNavire['voile']);
    $("#canonAdverse").val(unNavire['canon']);
    $("#bouletCanonAdverse").val(unNavire['bouletCanon']);

    evenInputNavireChange(unNavire['id'], ".inputCaracteristiqueNavireAdverse");
}

function afficherDeCombat(valeurDe){
    $("#deAuto").empty().append("<div class=\"unDes\">" + valeurDe + "</div>");
}

function evenSelectListeNavireChange(divEvent) {
    $(divEvent).change(function () {
        $(location).attr('href', "./index.php?action=navire&navire=" + $("#listeNavire").val() + "&navireAdverse=" + $("#listeNavireAdverse").val());
    });
}

function evenButtonLancerConbatNavire(divEvent, idNavire, idNavireAdverse) {
    $(divEvent).click(function () {
        insertEventAnimation(idNavire + ";" + idNavireAdverse, "lanceCombatNavire");
    });
}

function evenLancerCanonClick(idNavire, idNavireAdverse){
    if (idNavire != "" && idNavireAdverse != ""){
        $("#lancerCanonByNavire").click(function () {
            bootbox.prompt({
                title: "valeur du dé",
                value: "",
                callback: function (result) {
                    if (result == "" || Number.isInteger(result)) {
                        afficherMessage(4, "valeur du dé vide", 0);
                    } else if (result !== null) {
                        attaqueCanon(idNavire, idNavireAdverse, result, false);
                        insertEventAnimation("navireCanonAttaque", "combatNavire");
                    }
                }
            });
        });
        $("#lancerCanonByNavireAdverse").click(function () {
            attaqueCanon(idNavireAdverse, idNavire, Math.floor((Math.random() * 100) + 1), true);
            insertEventAnimation("navireAdverseCanonAttaque", "combatNavire");
        });
    }
}

function evenLancerEquipageClick(idNavire, idNavireAdverse){
    if (idNavire != "" && idNavireAdverse != ""){
        $("#lancerEquipageByNavire").click(function () {
            bootbox.prompt({
                title: "valeur du dé",
                value: "",
                callback: function (result) {
                    if (result == "" || Number.isInteger(result)) {
                        afficherMessage(4, "valeur du dé vide", 0);
                    } else if (result !== null) {
                        attaqueEquipage(idNavire, idNavireAdverse, result, false);
                        insertEventAnimation("navireEquipageAttaque", "combatNavire");
                    }
                }
            });
        });
        $("#lancerEquipageByNavireAdverse").click(function () {
            attaqueEquipage(idNavireAdverse, idNavire, Math.floor((Math.random() * 100) + 1), true);
            insertEventAnimation("navireAdverseEquipageAttaque", "combatNavire");
        });
    }
}

function evenInputNavireChange(idNavire, divEvent) {
    if (idNavire != "") {
        $(divEvent).change(function () {
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurTable("navire", idNavire, champ, valeur);
        });
    }
}

function attaqueCanon(idNavire, idNavireAdverse, valeurDe, navireAdverse){
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
                var cible = "Adverse";
                var soi = "";
                var unNavire = JSON.parse(data);

                if (navireAdverse){
                    cible = "";
                    soi = "Adverse";
                }

                if (unNavire.id !== undefined && unNavire.id != "" && unNavire.bouletCanon > 0 && unNavire.canon > 0) {
                    var nbCanon = parseInt(unNavire['canon']);
                    var cibleCoque = $("#coque" + cible);
                    var cibleEquipage = $("#equipage" + cible);
                    var cibleCanone = $("#canon" + cible);

                    if (parseInt(unNavire['bouletCanon']) > parseInt(unNavire['canon'])){
                        unNavire['bouletCanon'] = unNavire['bouletCanon'] - unNavire['canon'];
                    }else{
                        nbCanon = parseInt(unNavire['bouletCanon']);
                        unNavire['bouletCanon'] = 0;
                    }

                    var coque = cibleCoque.val() - Math.floor(((100-valeurDe)*nbCanon/100)*degatCanonCoque);
                    var equipage = cibleCoque.val() - Math.floor(((100-valeurDe)*nbCanon/100)*degatCanonEquipage);
                    var canon = cibleCoque.val() - Math.floor(((100-valeurDe)*nbCanon/100)*degatCanonCanon);

                    modifierValeurTable("navire", idNavire, "bouletCanon", unNavire['bouletCanon']);
                    modifierValeurTable("navire", idNavireAdverse, "coque", coque);
                    modifierValeurTable("navire", idNavireAdverse, "equipage", equipage);
                    modifierValeurTable("navire", idNavireAdverse, "canon", canon);

                    $("#bouletCanon" + soi).val(unNavire['bouletCanon']);
                    cibleEquipage.val(equipage);
                    cibleCoque.val(coque);
                    cibleCanone.val(canon);
                    afficherDeCombat(valeurDe);
                } else if (unNavire.bouletCanon <= 0 || unNavire.canon <= 0){
                    console.error("plus de boulet de canon ou plus de canon");
                    afficherMessage(3, "plus de boulet de canon ou plus de canon", 0);
                } else {
                    console.error("id attaqueCanon : " + data);
                    afficherMessage(4, "id attaqueCanon : " + data, 0);
                }
            } catch (e) {
                console.error("attaqueCanon : " + e + "(" + data + ")");
                afficherMessage(4, "attaqueCanon : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery attaqueCanon (" + idNavire + ")");
            afficherMessage(4, "erreur sur la fonction JQuery attaqueCanon (" + idNavire + ")", 0);
        }
    });
}

function attaqueEquipage(idNavire, idNavireAdverse, valeurDe, navireAdverse){
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
                var cible = "Adverse";
                var unNavire = JSON.parse(data);

                if (navireAdverse) cible = "";

                if (unNavire.id !== undefined && unNavire.id != "" && unNavire.equipage > 0) {
                    var cibleEquipage = $("#equipage" + cible);
                    var equipage = cibleEquipage.val() - Math.floor(((100-valeurDe)*unNavire['equipage']/100)*degatEquipageEquipage);

                    modifierValeurTable("navire", idNavireAdverse, "equipage", equipage);
                    cibleEquipage.val(equipage);
                    afficherDeCombat(valeurDe);
                } else if (unNavire.equipage <= 0){
                    console.error("plus d'équipage");
                    afficherMessage(3, "plus d'équipage", 0);
                } else {
                    console.error("id attaqueEquipage : " + data);
                    afficherMessage(4, "id attaqueEquipage : " + data, 0);
                }
            } catch (e) {
                console.error("attaqueEquipage : " + e + "(" + data + ")");
                afficherMessage(4, "attaqueEquipage : " + e + "(" + data + ")", 0);
            }
        },
        error: function () {
            console.error("erreur sur la fonction JQuery attaqueEquipage (" + idNavire + ")");
            afficherMessage(4, "erreur sur la fonction JQuery attaqueEquipage (" + idNavire + ")", 0);
        }
    });
}