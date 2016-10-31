function affichageNavire(IDNavire,navireAdverse){
    if (IDNavire != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getNavireID",
                IDNavire: IDNavire
            },
            success: function(data){
                try{
                    var unNavire = JSON.parse(data);
                    if (!navireAdverse) afficherNavire(unNavire);
                    // else afficherNavireAdverse(unNavire);
                }catch (e){
                    console.error("affichageunNavire : " + e + "(" + data + ")");
                    afficherMessage(4, "affichageunNavire : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery affichageunNavire (" + unNavire + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichageunNavire (" + unNavire + ")", 0);
            }
        });
    }
}function afficherNavire(unNavire){
    $("#equipage").val(unNavire['equipage']);
    $("#coque").val(unNavire['coque']);
    $("#voile").val(unNavire['voile']);
    $("#canon").val(unNavire['canon']);
    $("#bouletCanon").val(unNavire['bouletCanon']);

    evenInputNavireChange(unNavire['id']);
}

function evenSelectListeNavireChange(){
    $("#listeNavire").change(function(){
        IDNavire = $(this).val();
        affichageNavire(IDNavire,false);
    });
    $("#listeNavireAdverse").change(function(){
        IDNavireAdverse = $(this).val();
        affichageNavire(IDNavireAdverse,true);
    });
}

function evenInputNavireChange(IDNavire){
    if (IDNavire != ""){
        $(".inputCaracteristiqueNavire").change(function(){
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurNavire(IDNavire, champ, valeur);
        });
    }
}

function modifierValeurNavire(IDNavire, champ, valeur){
    if (IDNavire != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "modifierValeurNavire",
                IDNavire: IDNavire,
                champNavire: champ,
                valeurNavire: valeur
            },
            success: function(data){
                if (data != ""){
                    console.error("modifierValeurNavire : (" + data + ")");
                    afficherMessage(4, "modifierValeurNavire : (" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery modifierValeurNavire (" + IDNavire + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurNavire (" + IDNavire + ")", 0);
            }
        });
    }
}