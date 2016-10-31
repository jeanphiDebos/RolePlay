    <div id="listeErreur">
        <?php if ($erreur != "") echo $erreur; ?>
    </div>
    <div id="enTete">
        <?php if (isset($personnage)){ ?>
            <div id="versFichePersonnage" class="vers">
                <a id="lienVersFichePersonnage" class="lienVers" href="../personnage/index.php?perso=<?php echo $personnage; ?>">Retour à la fiche du perso</a>
            </div>
        <?php } ?>
    </div>
    <div id="Corps">
        <div class="row clearfix">
            <div class="col-md-12 column" id="carte"></div>
        </div>
    </div>
    <script type="text/javascript" src="./evenement.js"></script>
    <script>
        var idCarte = "";
        $(document).ready(function(){
            $( window ).resize(function() {
                redimensionnerCarte();
            });

            affichageCarte();
        });
    </script>
</body>
</html>