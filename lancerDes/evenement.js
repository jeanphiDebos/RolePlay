function eventButtonLancerDes(){
    $("#lancerDes").click(function(){
        var nombreDes = $("#nombreDes").val();
        var valeurDes = $("#valeurDes").val();
        if (nombreDes != "" && valeurDes != ""){
            $("#resultatDes").empty();
            for (var i = 0; i < nombreDes; i++){
                $("#resultatDes").append(afficherDes(Math.floor((Math.random() * valeurDes) + 1)));
            }
        }
    });
}

function afficherDes(valeurDes){
    var string = "<div class=\"col-md-2 column\"><div class=\"unDes\">" + valeurDes + "</div></div>";
    return string;
}