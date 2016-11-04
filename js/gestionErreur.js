/**
 * typeMessage = 1 : messageSucces; typeMessage = 2 : messageInfo; typeMessage = 3 : messageWarning; typeMessage = 4 : messageDanger
 * tempsAfficher = temps d'affichage en seconde
 */
var indiceMessageAlerte = 0;

function afficherMessage(typeMessage, textMessage, tempsAfficher) {
    if (tempsAfficher == undefined) tempsAfficher = 5;
    tempsAfficher = tempsAfficher * 1000;
    var idMessage = "messageAlerte" + indiceMessageAlerte;
    var messageAlerte = "";
    var classAlerte = "";

    if (typeMessage == 1) classAlerte = "alert-success";
    else if (typeMessage == 2) classAlerte = "alert-info";
    else if (typeMessage == 3) classAlerte = "alert-warning";
    else if (typeMessage == 4) classAlerte = "alert-danger";

    if (classAlerte != "") {
        messageAlerte = "<div id=\"" + idMessage + "\" class=\"alert " + classAlerte + "\" role=\"alert\">" + textMessage;
        if (tempsAfficher != 0) {
            setTimeout("fermerMessage('" + idMessage + "')", tempsAfficher);
        } else {
            messageAlerte += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" onclick=\"fermerMessage('" + idMessage + "')\"><span aria-hidden=\"true\">&times;</span></button>";
        }
        messageAlerte += "</div>";
        // $("#listeErreur").empty();
        $("#listeErreur").append(messageAlerte);
        // $("#"+idMessage).show( "fast" );
        $("#" + idMessage).show();
        indiceMessageAlerte++;
    }
}

function fermerMessage(idMessage) {
    // $("#"+idMessage).hide(1000);
    $("#" + idMessage + "").slideToggle("fast");
}