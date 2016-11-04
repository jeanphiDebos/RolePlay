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

    evenInputNavireChange(unNavire['id'], "#equipageAdverse");
}

function evenSelectListeNavireChange(divEvent) {
    $(divEvent).change(function () {
        $(location).attr('href', "./index.php?action=navire&navire=" + $("#listeNavire").val() + "&navireAdverse=" + $("#listeNavireAdverse").val());
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
                    }
                }
            });
        });
        $("#lancerCanonByNavireAdverse").click(function () {
            attaqueCanon(idNavireAdverse, idNavire, Math.floor((Math.random() * 100) + 1), true);
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
                    }
                }
            });
        });
        $("#lancerEquipageByNavireAdverse").click(function () {
            attaqueEquipage(idNavireAdverse, idNavire, Math.floor((Math.random() * 100) + 1), true);
        });
    }
}

function evenInputNavireChange(idNavire, divEvent) {
    if (idNavire != "") {
        $(divEvent).change(function () {
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurNavire(idNavire, champ, valeur);
        });
    }
}

function modifierValeurNavire(idNavire, champ, valeur) {
    if (idNavire != "") {
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "updateValeurDonnee",
                table: "navire",
                id: idNavire,
                champ: champ,
                valeur: valeur
            },
            success: function (data) {
                if (data != "") {
                    console.error("modifierValeurNavire : (" + data + ")");
                    afficherMessage(4, "modifierValeurNavire : (" + data + ")", 0);
                }
            },
            error: function () {
                console.error("erreur sur la fonction JQuery modifierValeurNavire (" + idNavire + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurNavire (" + idNavire + ")", 0);
            }
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
                    var nbCanon = unNavire['canon'];

                    if (unNavire['bouletCanon'] < unNavire['canon']){
                        unNavire['bouletCanon'] -= unNavire['canon'];
                    }else{
                        nbCanon = unNavire['bouletCanon'];
                        unNavire['bouletCanon'] = 0;
                    }

                    var degatCoque = Math.floor(((100-valeurDe)*nbCanon/100)*degatCanonCoque);
                    var degatEquipage = Math.floor(((100-valeurDe)*nbCanon/100)*degatCanonEquipage);
                    var degatCanon = Math.floor(((100-valeurDe)*nbCanon/100)*degatCanonCanon);

                    modifierValeurNavire(idNavire, "bouletCanon", unNavire['bouletCanon']);
                    modifierValeurNavire(idNavireAdverse, "coque", degatCoque);
                    modifierValeurNavire(idNavireAdverse, "equipage", degatEquipage);
                    modifierValeurNavire(idNavireAdverse, "canon", degatCanon);

                    $("#bouletCanon" + soi).val(unNavire['bouletCanon']);
                    var cibleEquipage = $("#equipage" + cible);
                    cibleEquipage.val(cibleEquipage.val() - degatEquipage);
                    var cibleCoque = $("#coque" + cible);
                    cibleCoque.val(cibleCoque.val() - degatCoque);
                    var cibleCanone = $("#canon" + cible);
                    cibleCanone.val(cibleCanone.val() - degatCanon);
                } else if (unNavire.bouletCanon <= 0 || unNavire.canon <= 0){
                    console.error("plus de boulet de canon ou plus de canon : ");
                } else {
                    console.error("id attaqueCanon : " + data);
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
                    var nbEquipage = unNavire['equipage'];

                    var degatEquipage = Math.floor(((100-valeurDe)*nbEquipage/100)*degatEquipageEquipage);

                    modifierValeurNavire(idNavireAdverse, "equipage", degatEquipage);

                    var cibleEquipage = $("#equipage" + cible);
                    cibleEquipage.val(cibleEquipage.val() - degatEquipage);
                } else {
                    console.error("id attaqueEquipage : " + data);
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