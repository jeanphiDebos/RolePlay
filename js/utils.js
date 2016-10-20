function eventUploadFichier(div, classOption){
    $("#uploadFichier #file").change(function(){

        jQuery.ajax({
            type: "POST",
            url: "../model/ajaxPhpFile.php",
            data: new FormData($("#uploadFichier")[0]),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                try{
                    var fichierUpload = JSON.parse(data);

                    $(div).append("<option value='" + fichierUpload + "' class=\"" + classOption + "\">" + fichierUpload.substr(0, fichierUpload.indexOf('.')) + "</option>");
                }catch (e){
                    console.error("uploadFichier : " + e + "(" + data + ")");
                    afficherMessage(4, "uploadFichier : " + e + "(" + data + ")", 0);
                }
            },
            error: function(){
                console.error("erreur sur la fonction JQuery uploadFichier");
                afficherMessage(4, "erreur sur la fonction JQuery uploadFichier", 0);
            }
        });
    });
}

function convertirDateUSFR(dateUS){
    dateUS = dateUS.split(' ');

    var dateValeur = dateUS[0].split('-');
    var heureValeur = dateUS[1];

    if (dateValeur.length == 3){
        var jour = dateValeur[2];
        var mois = dateValeur[1];
        var annee = dateValeur[0];
        return heureValeur + " " + jour + "/" + mois + "/" + annee;
    }else{
        return "NoValidDate";
    }
}

function dateNow(){
    var dateNow = new Date();
    var jour = dateNow.getDate();
    var mois = dateNow.getMonth();
    var annee = dateNow.getFullYear();

    var heure = dateNow.getHours();
    var minute = dateNow.getMinutes();
    var seconde = dateNow.getSeconds();

    if (jour.toString().length == 1) jour = "0" + jour.toString();
    mois = parseInt(mois) + 1;
    if (mois.toString().length == 1) mois = "0" + mois.toString();
    if (heure.toString().length == 1) heure = "0" + heure.toString();
    if (minute.toString().length == 1) minute = "0" + minute.toString();
    if (seconde.toString().length == 1) seconde = "0" + seconde.toString();

    var now = annee + "-" + mois + "-" + jour + " " + heure + ":" + minute + ":" + seconde;
    return now;
}