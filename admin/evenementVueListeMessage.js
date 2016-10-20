function affichageNombreMessageJoueurNonLue(){
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "countMessageJoueur"
        },
        success: function(data){
            try{
                nombreMessageNonLue = JSON.parse(data);
                if (nombreMessageNonLue.nombreMessage != ""){
                    afficherNombreMessageNonLue(nombreMessageNonLue.nombreMessage);
                }
            }catch (e){
                console.error("affichageNombreMessageJoueurNonLue : " + e + "(" + data + ")");
            }
            setTimeout("affichageNombreMessageJoueurNonLue()", 1000);
        },
        error: function(){
            console.error("erreur sur la fonction JQuery affichageNombreMessageJoueurNonLue");
        }
    });
}

function allMessagesLue(){
    jQuery.ajax({
        type: "GET",
        url: "../model/requeteAJAX.php",
        data: {
            action: "allMessagesJoueurLue"
        },
        success: function(data){
            if (data != ""){
                console.error("allMessagesLue : " + e + "(" + data + ")");
            }
        },
        error: function(){
            console.error("erreur sur la fonction JQuery allMessagesLue (" + nomPersonnage + ")");
        }
    });
}
function afficherNombreMessageNonLue(nombreMessageNonLue){
    $("#messageNonLue").empty().append(nombreMessageNonLue);
    if (nombreMessageNonLue == 0){
        $("#messageDesJoueur").removeClass("danger").addClass("default");
    }else{
        $("#messageDesJoueur").removeClass("default").addClass("danger");
    }
}