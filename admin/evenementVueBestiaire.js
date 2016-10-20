function affichageImageMonstre(IDMonstre, pathUploadFichier){
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "listingElementsDossier",
            dossierElement: pathUploadFichier
        },
        success: function(data){
            try{
                var listeImageCarte = JSON.parse(data);
                
                for (var i = 0; i <listeImageCarte.length; i++){
                    $("#imageMonstre").append("<option value='" + listeImageCarte[i] + "' class=\"imageMonstreOption\">" + listeImageCarte[i].substr(0, listeImageCarte[i].indexOf('.')) + "</option>");
                }
            }catch (e){
                console.error("affichageImageMonstre : " + e + "(" + data + ")");
                afficherMessage(4, "affichageImageMonstre : " + e + "(" + data + ")", 0);
            }

            affichageMonstre(IDMonstre);
        },
        error: function(){
            console.error("erreur sur la fonction JQuery affichageImageMonstre");
            afficherMessage(4, "erreur sur la fonction JQuery affichageImageMonstre", 0);
        }
    });
}

function affichageMonstre(IDMonstre){
    if (IDMonstre != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getMonstreID",
                IDMonstre: IDMonstre
            },
            success: function(data){
                try{
                    var unMonstre = JSON.parse(data);
                    afficherMonstre(unMonstre);
                }catch (e){
                    console.error("affichageMonstre : " + e + "(" + data + ")");
                    afficherMessage(4, "affichageMonstre : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery affichageMonstre (" + IDMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichageMonstre (" + IDMonstre + ")", 0);
            }
        });
    }
}

function afficherMonstre(unMonstre){
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

function evenSelectListeMonstreChange(){
    $("#listeMonstres").change(function(){
        var idMonstre = $(this).val();
        $(location).attr('href', "./index.php?action=bestiaire&monstre=" + idMonstre);
    });
}

function evenButtonAddMonstreClick(){
    $("#addMonstre").click(function(){
        bootbox.prompt({
            title: "Nom du nouveau Monstre",
            value: "",
            callback: function(result){
                if (result == ""){
                    console.error("nom du nouveau Monstre vide");
                    afficherMessage(4, "nom du nouveau Monstre vide", 0);
                }else if (result !== null){
                    ajoutMonstre(result);
                }
            }
        });
    });
}

function evenButtonDeleteMonstreClick(IDMonstre){
    if (IDMonstre != ""){
        $("#deletMonstre").click(function(){
            bootbox.confirm("Are you sure?", function(result){
                if (result) supprimerMonstre(IDMonstre);
            });
        });
    }
}

function evenInputMonstreChange(IDMonstre){
    if (IDMonstre != ""){
        $(".inputDescriptionMonstre").change(function(){
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurMonstre(IDMonstre, champ, valeur);
        });
    }
}

function evenButtonCacherMonstreChange(IDMonstre){
    if (IDMonstre != ""){
        $(".inputCacheMonstre").on("switchChange.bootstrapSwitch", function(event, state){
            var stateSwitch = $(this).bootstrapSwitch('state');
            if (stateSwitch) isCacher = 1;
            else isCacher = 0;

            cacherMonstre(IDMonstre, isCacher);
        });
    }
}

function ajoutMonstre(nomMonstre){
    if (nomMonstre != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addMonstre",
                nomMonstre: nomMonstre
            },
            success: function(data){
                try{
                    unMonstre = JSON.parse(data);
                    $("#listeMonstres").append($("<option></option>").attr("value", unMonstre.id).attr("class", "unMonstreOption").text(unMonstre.nom));
                }catch (e){
                    console.error("ajoutMonstre : " + e + "(" + data + ")");
                    afficherMessage(4, "ajoutMonstre : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery ajoutMonstre (" + nomMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutMonstre (" + nomMonstre + ")", 0);
            }
        });
    }
}

function supprimerMonstre(IDMonstre){
    if (IDMonstre != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "deleteMonstre",
                IDMonstre: IDMonstre
            },
            success: function(data){
                if (data != ""){
                    console.error("supprimerMonstre : " + e + "(" + data + ")");
                    afficherMessage(4, "supprimerMonstre : " + e + "(" + data + ")", 0);
                }else{
                    $(location).attr('href', "./index.php?action=bestiaire&monstre=");
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery supprimerMonstre (" + IDMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery supprimerMonstre (" + IDMonstre + ")", 0);
            }
        });
    }
}

function modifierValeurMonstre(IDMonstre, champ, valeur){
    if (IDMonstre != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "modifierValeurMonstre",
                IDMonstre: IDMonstre,
                champMonstre: champ,
                valeurMonstre: valeur
            },
            success: function(data){
                if (data != ""){
                    console.error("modifierValeurMonstre : " + e + "(" + data + ")");
                    afficherMessage(4, "modifierValeurMonstre : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery modifierValeurMonstre (" + IDMonstre + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurMonstre (" + IDMonstre + ")", 0);
            }
        });
    }
}

function cacherMonstre(IDMonstre, isCacher){
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "cacherMonstre",
            IDMonstre: IDMonstre,
            isCacher: isCacher
        },
        success: function(data){
            if (data != ""){
                console.error("CacherMonstre : " + e + "(" + data + ")");
                afficherMessage(4, "CacherMonstre : " + e + "(" + data + ")", 0);
            }
        },
        error: function(){
            console.error("erreur sur la fonction JQuery cacherMonstre (" + IDMonstre + ")");
            afficherMessage(4, "erreur sur la fonction JQuery cacherMonstre (" + IDMonstre + ")", 0);
        }
    });
}