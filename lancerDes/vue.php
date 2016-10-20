    <div id="listeErreur">
        <?php if ($erreur != "") echo $erreur; ?>
    </div>
    <div id="enTete">
        <?php if (isset($personnage)){ ?>
            <div id="versFichePersonnage">
                <a id="lienVersFichePersonnage" href="../personnage/index.php?perso=<?php echo $personnage; ?>">Retour à la fiche du perso</a>
            </div>
        <?php } ?>
    </div>
    <div id="Corps" class="lanceurDeDes">
        <div class="row clearfix listeAction">
            <div class="col-md-3 column">
                <div class="input-group">
                    <span class="input-group-addon">nombre de dés</span>
                    <input type="number" class="form-control" id="nombreDes" min="1" value="2">
                </div>
            </div>
            <div class="col-md-3 column">
                <div class="input-group">
                    <span class="input-group-addon">valeur des dés</span>
                    <input type="number" class="form-control" id="valeurDes" min="2" value="10">
                </div>
            </div>
            <div class="col-md-2 column">
                <button type="button" id="lancerDes">lancer les dés</button>
            </div>
        </div>
        <div id="resultatDes" class="row clearfix">
        </div>
    </div>
    <script type="text/javascript" src="./evenement.js"></script>
    <script>
        $(document).ready(function(){
            eventButtonLancerDes();
        });
    </script>
</body>
</html>