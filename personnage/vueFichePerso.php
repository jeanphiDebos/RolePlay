    <div id="listeErreur">
        <?php if ($erreur != "") echo $erreur; ?>
    </div>
    <div id="enTete">
        <div id="messageDuMJ">
            <a id="lienVersMessage" href="./index.php?perso=<?php echo $personnage; ?>&action=listeMessage">
                <div id="messageNonLue"></div>
                <div id="voirMessage">Message du MJ</div>
            </a>
        </div>
        <div id="versBestiaire">
            <a id="lienVersBestiaire" href="../bestiaire/index.php">Voir la Bestiaire</a>
        </div>
        <div id="versCarte">
            <a id="lienVersCarte" href="../carte/index.php">Voir la Carte</a>
        </div>
        <div id="versLancerDes">
            <a id="lienVersLancerDes" href="../lancerDes/index.php">Dés Virtuel</a>
        </div>
    </div>
    <div id="Corps" class="fichePersonnage">
        <div class="row clearfix">
            <input type="radio" name="radioPosture" data-on-color="success" data-off-color="default" data-label-text="Attaque" data-on-text="On" data-off-text="-" class="inputPosturePersonnage" checked>
            <input type="radio" name="radioPosture" data-on-color="success" data-off-color="default" data-label-text="Defence" data-on-text="On" data-off-text="-" class="inputPosturePersonnage">
            <input type="radio" name="radioPosture" data-on-color="success" data-off-color="default" data-label-text="Focus" data-on-text="On" data-off-text="-" class="inputPosturePersonnage">
        </div>
        <div class="row clearfix">
            <div class="col-md-2 column glyphicon glyphicon-lvl" id="lvl"></div>
            <div class="col-md-3 column glyphicon glyphicon-classe" id="classe"></div>
            <div class="col-md-3 column glyphicon glyphicon-metier" id="metier"></div>
            <div class="col-md-2 column glyphicon glyphicon-vie" id="vie"></div>
            <div class="col-md-2 column glyphicon glyphicon-mana" id="mana"></div>
        </div>
        <div class="row clearfix">
            <div class="col-md-2 column glyphicon glyphicon-force" id="force">/100</div>
            <div class="col-md-2 column glyphicon glyphicon-education" id="education">/100</div>
            <div class="col-md-2 column glyphicon glyphicon-dexterite" id="dexterite">/100</div>
            <div class="col-md-2 column glyphicon glyphicon-perception" id="perception">/100</div>
            <div class="col-md-2 column glyphicon glyphicon-constitution" id="constitution">/100</div>
            <div class="col-md-1 column glyphicon glyphicon-charisme" id="charisme">/100</div>
            <div class="col-md-1 column glyphicon glyphicon-chance" id="chance">/100</div>
        </div>
        <div class="row clearfix">
            <div class="col-md-4 column glyphicon glyphicon-competence" id="competence"></div>
            <div class="col-md-4 column glyphicon glyphicon-sort" id="sort"></div>
            <div class="col-md-4 column glyphicon glyphicon-equipement" id="equipement"></div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column glyphicon glyphicon-inventaire">
                <textarea name="inventaire" id="inventaire" class="inputDescriptionPersonnage"></textarea>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column glyphicon glyphicon-po" id="po"></div>
        </div>
    </div>
    <audio preload="none" src="" id="son"></audio>
    <script type="text/javascript" src="./evenement.js"></script>
    <script type="text/javascript" src="../js/bootstrap-switch.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".inputPosturePersonnage").bootstrapSwitch('state', false);
            affichagePersonnage("<?php echo $personnage; ?>");
            evenInputPersonnageChange("<?php echo $personnage; ?>");
            verifJouerSon("<?php echo $personnage; ?>", dateNow(), "<?php echo $_SESSION['idSession']?>");
        });
    </script>
</body>
</html>