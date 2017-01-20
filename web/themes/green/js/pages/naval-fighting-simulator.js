function initEventAttack(damageCanonShell, damageCanonCrew, damageCanonCanon, damageCrewCrew, urlAjax){
    $("#attackCanon").click(function () {
        bootbox.prompt({
            title: "valeur du dé",
            value: "",
            callback: function (result) {
                if (result == "" || Number.isInteger(result) || result > 100) {
                    // afficherMessage(4, "valeur du dé vide", 0);
                } else if (result !== null) {
                    attackCanon(result, false, damageCanonShell, damageCanonCrew, damageCanonCanon, urlAjax);
                }
            }
        });
    });
    $("#attackCanonAdverse").click(function () {
        attackCanon(Math.floor((Math.random() * 100) + 1), true, damageCanonShell, damageCanonCrew, damageCanonCanon, urlAjax);
    });
    $("#attackCrew").click(function () {
        bootbox.prompt({
            title: "valeur du dé",
            value: "",
            callback: function (result) {
                if (result == "" || Number.isInteger(result) || result > 100) {
                    // afficherMessage(4, "valeur du dé vide", 0);
                } else if (result !== null) {
                    attackCrew(result, false, damageCrewCrew, urlAjax);
                }
            }
        });
    });
    $("#attackCrewAdverse").click(function () {
        attackCrew(Math.floor((Math.random() * 100) + 1), true, damageCrewCrew, urlAjax);
    });
}

function attackCanon(valeurDe, navireAdverse, damageCanonShell, damageCanonCrew, damageCanonCanon, urlAjax){
    try {
        var cible = "Adverse";
        var soi = "";
        var ship = [];

        if (navireAdverse){
            cible = "";
            soi = "Adverse";
        }
        
        ship['shell'] = $("#shell" + soi).val();
        ship['crew'] = $("#crew" + soi).val();
        ship['canon'] = $("#canon" + soi).val();
        ship['cannonball'] = $("#cannonball" + soi).val();

        if (ship['cannonball'] > 0 && ship['canon'] > 0) {
            var countCanon = parseInt(ship['canon']);
            var cibleShell = $("#shell" + cible);
            var cibleCrew = $("#crew" + cible);
            var cibleCanone = $("#canon" + cible);

            if (parseInt(ship['cannonball']) > parseInt(ship['canon'])){
                ship['cannonball'] = ship['cannonball'] - ship['canon'];
            }else{
                countCanon = parseInt(ship['cannonball']);
                ship['cannonball'] = 0;
            }

            var shell = cibleShell.val() - Math.floor(((100-valeurDe)*countCanon/100)*damageCanonShell);
            var crew = cibleShell.val() - Math.floor(((100-valeurDe)*countCanon/100)*damageCanonCrew);
            var canon = cibleShell.val() - Math.floor(((100-valeurDe)*countCanon/100)*damageCanonCanon);

            $("#cannonball" + soi).val(ship['cannonball']);
            cibleCrew.val(crew);
            cibleShell.val(shell);
            cibleCanone.val(canon);
            $("#deAuto").empty().append("<div class=\"oneDes\">" + valeurDe + "</div>");
            addNewEvent(crew, "crewDamage" + cible, "navalFightingSimulator", urlAjax);
            addNewEvent(shell, "shellDamage" + cible, "navalFightingSimulator", urlAjax);
            addNewEvent(canon, "canonDamage" + cible, "navalFightingSimulator", urlAjax);
            addNewEvent(ship['cannonball'], "cannonball" + soi, "navalFightingSimulator", urlAjax);
        } else if (ship.cannonball <= 0 || ship.canon <= 0){
            console.error("plus de boulet de canon ou plus de canon");
        } else {
            console.error("error attackCanon : " + ship);
        }
    } catch (e) {
        console.error("attackCanon : " + e);
    }
}

function attackCrew(valeurDe, navireAdverse, damageCrewCrew, urlAjax){
    try {
        var soi = "";
        var cible = "Adverse";
        var ship = [];

        if (navireAdverse){
            cible = "";
            soi = "Adverse";
        }

        ship['crew'] = $("#crew" + soi).val();

        if (ship['crew'] > 0) {
            var cibleCrew = $("#crew" + cible);
            var crew = cibleCrew.val() - Math.floor(((100-valeurDe)*ship['crew']/100)*damageCrewCrew);

            cibleCrew.val(crew);
            $("#deAuto").empty().append("<div class=\"oneDes\">" + valeurDe + "</div>");
            addNewEvent(crew, "crewDamage" + cible, "navalFightingSimulator", urlAjax);
        } else if (ship.crew <= 0){
            console.error("plus d'équipage");
        } else {
            console.error("error attackCrew : " + ship);
        }
    } catch (e) {
        console.error("attackCrew : " + e);
    }
}

function addNewEvent(valeur, animation, forEvent, urlAjax){
    $.ajax({
        url: urlAjax,
        type: "POST",
        data: {'valeur' : valeur, 'animation' : animation, 'for' : forEvent},
        cache: false,
        error: function(XMLHttpRequest, textStatus, errorThrown)
        {
            console.error('Error: ' +  errorThrown);
        }
    });
}