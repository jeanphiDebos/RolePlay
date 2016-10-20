function affichagePersonnage(IDPersonnage){
    if (IDPersonnage != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "getPersonnageID",
                IDPersonnage: IDPersonnage
            },
            success: function(data){
                try{
                    unPersonnage = JSON.parse(data);
                    if (unPersonnage != "") afficherPersonnage(unPersonnage);
                }catch (e){
                    console.error("affichagePersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "affichagePersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery affichagePersonnage (" + IDPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery affichagePersonnage (" + IDPersonnage + ")", 0);
            }
        });
    }
}

function afficherPersonnage(unPersonnage){
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

function evenSelectListePersonnageChange(){
    $("#listePersonnage").change(function(){
        var idPerso = $(this).val();
        $(location).attr('href', "./index.php?perso=" + idPerso);
    });
}

function evenButtonAddPersonnageClick(){
    $("#addPersonnage").click(function(){
        bootbox.prompt({
            title: "Nom du nouveau Personnage",
            value: "",
            callback: function(result){
                if (result == ""){
                    afficherMessage(4, "nom du nouveau personnage vide", 0);
                }else if (result !== null){
                    ajoutPersonnage(result);
                }
            }
        });
    });
}

function evenButtonDeletPersonnageClick(IDPersonnage){
    if (IDPersonnage != ""){
        $("#deletPersonnage").click(function(){
            bootbox.confirm("Are you sure?", function(result){
                if (result) supprimerPersonnage(IDPersonnage);
            });
        });
    }
}

function evenButtonSendMessagePersonnageClick(IDPersonnage){
    if (IDPersonnage != ""){
        $("#sendMessagePersonnage").click(function(){
            bootbox.prompt({
                title: "Message au joueur",
                value: "",
                callback: function(result){
                    if (result == ""){
                        afficherMessage(4, "Message au joueur vide", 0);
                    }else if (result !== null){
                        ajoutMessage(IDPersonnage, result);
                    }
                }
            });
        });
    }
}

function evenInputPersonnageChange(IDPersonnage){
    if (IDPersonnage != ""){
        $(".inputDescriptionPersonnage").change(function(){
            var champ = $(this).attr('name');
            var valeur = $(this).val();

            modifierValeurPersonnage(IDPersonnage, champ, valeur);
        });
    }
}

function ajoutPersonnage(nomPersonnage){
    if (nomPersonnage != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addPersonnage",
                nomPersonnage: nomPersonnage
            },
            success: function(data){
                try{
                    unPersonnage = JSON.parse(data);
                    $("#listePersonnage").append($("<option></option>").attr("value", unPersonnage.id).attr("class", "unPersonnageOption").text(unPersonnage.nom));
                }catch (e){
                    console.error("ajoutPersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "ajoutPersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery ajoutPersonnage (" + nomPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutPersonnage (" + nomPersonnage + ")", 0);
            }
        });
    }
}

function supprimerPersonnage(IDPersonnage){
    if (IDPersonnage != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "deletePersonnage",
                IDPersonnage: IDPersonnage
            },
            success: function(data){
                if (data != ""){
                    console.error("supprimerPersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "supprimerPersonnage : " + e + "(" + data + ")", 0);
                }else{
                    $(location).attr('href', "./index.php?perso=");
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery supprimerPersonnage (" + IDPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery supprimerPersonnage (" + IDPersonnage + ")", 0);
            }
        });
    }
}

function ajoutMessage(IDPersonnage, message){
    if (IDPersonnage != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "addMessage",
                IDPersonnage: IDPersonnage,
                message: message
            },
            success: function(data){
                if (data != ""){
                    console.error("ajoutMessage : " + e + "(" + data + ")");
                    afficherMessage(4, "ajoutMessage : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery ajoutMessage (" + IDPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery ajoutMessage (" + IDPersonnage + ")", 0);
            }
        });
    }
}

function modifierValeurPersonnage(IDPersonnage, champ, valeur){
    if (IDPersonnage != ""){
        jQuery.ajax({
            type: "GET",
            url: "../model/requeteAJAX.php",
            data: {
                action: "modifierValeurPersonnage",
                IDPersonnage: IDPersonnage,
                champPersonnage: champ,
                valeurPersonnage: valeur
            },
            success: function(data){
                if (data != ""){
                    console.error("modifierValeurPersonnage : " + e + "(" + data + ")");
                    afficherMessage(4, "modifierValeurPersonnage : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery modifierValeurPersonnage (" + IDPersonnage + ")");
                afficherMessage(4, "erreur sur la fonction JQuery modifierValeurPersonnage (" + IDPersonnage + ")", 0);
            }
        });
    }
}