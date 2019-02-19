<div id="listeErreur">
    <?php if ($erreur != "") echo $erreur; ?>
</div>
<div id="enTete">
    <div id="messageDuMJ" class="vers">
        <a id="lienVersMessage" class="lienVers"
           href="./index.php?perso=<?php echo $_SESSION['perso']; ?>&action=listeMessage">
            <div id="messageNonLue"></div>
            <div id="voirMessage">Message du MJ</div>
        </a>
    </div>
    <div id="versBestiaire" class="vers">
        <a id="lienVersBestiaire" class="lienVers" href="../bestiaire/index.php">Voir la Bestiaire</a>
    </div>
    <div id="versCarte" class="vers">
        <a id="lienVersCarte" class="lienVers" href="../carte/index.php">Voir la Carte</a>
    </div>
    <div id="versLancerDes" class="vers">
        <a id="lienVersLancerDes" class="lienVers" href="../lancerDes/index.php">Dés Virtuel</a>
    </div>
</div>
<div id="Corps" class="row fichePersonnage text-center">
    <div class="col-xs-offset-1 col-xs-10 col-md-offset-0 col-md-12">
        <div class="row clearfix">
            <input type="radio" name="radioPosture" data-on-color="success" data-off-color="default"
                   data-label-text="Attaque" data-on-text="On" data-off-text="-" class="inputPosturePersonnage" checked>
            <input type="radio" name="radioPosture" data-on-color="success" data-off-color="default"
                   data-label-text="Defence" data-on-text="On" data-off-text="-" class="inputPosturePersonnage">
            <input type="radio" name="radioPosture" data-on-color="success" data-off-color="default" data-label-text="Focus"
                   data-on-text="On" data-off-text="-" class="inputPosturePersonnage">
        </div>
        <hr>
        <div class="row clearfix">
            <div class="col-xs-4 col-md-3 col-md-offset-3 column">
                <span class="glyphicon glyphicon-lvl" id="lvl"></span>
            </div>
            <div class="col-xs-4 col-md-3 column">
                <span class="glyphicon glyphicon-classe" id="classe"></span>
            </div>
            <div class="col-xs-4 col-md-3 column">
                <span class="glyphicon glyphicon-metier" id="metier"></span>
            </div>
        </div>
        <hr>
        <div class="row clearfix">
            <div class="col-xs-6 col-md-3 col-md-offset-4 column">
                <span class="glyphicon glyphicon-vie" id="vie"></span>
            </div>
            <div class="col-xs-6 col-md-3 column">
                <span class="glyphicon glyphicon-mana" id="mana"></span>
            </div>
        </div>
        <hr>
        <div class="row clearfix">
            <div class="col-xs-6 col-md-2 col-md-offset-2 column">
                <span class="glyphicon glyphicon-force" id="force"></span>
            </div>
            <div class="col-xs-6 col-md-2 column">
                <span class="glyphicon glyphicon-education" id="education"></span>
            </div>
            <div class="col-xs-6 col-md-2 column">
                <span class="glyphicon glyphicon-dexterite" id="dexterite"></span>
            </div>
            <div class="col-xs-6 col-md-2 column">
                <span class="glyphicon glyphicon-perception" id="perception"></span>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-xs-6 col-md-2 col-md-offset-2 column">
                <span class="glyphicon glyphicon-constitution" id="constitution"></span>
            </div>
            <div class="col-xs-6 col-md-2 column">
                <span class="glyphicon glyphicon-charisme" id="charisme"></span>
            </div>
            <div class="col-xs-6 col-md-2 column">
                <span class="glyphicon glyphicon-chance" id="chance"></span>
            </div>
        </div>
        <hr>
        <div class="row clearfix">
            <div class="col-xs-12 col-md-4 column">
                <span class="glyphicon glyphicon-competence" id="competence"></span>
            </div>
            <div class="col-xs-12 col-md-4 column">
                <span class="glyphicon glyphicon-sort" id="sort"></span>
            </div>
            <div class="col-xs-12 col-md-4 column">
                <span class="glyphicon glyphicon-equipement" id="equipement"></span>
            </div>
        </div>
        <hr>
        <div class="row clearfix">
            <div class="col-md-12 column">
                <span class="glyphicon glyphicon-inventaire"></span>
                <textarea name="inventaire" id="inventaire" class="inputDescriptionPersonnage"></textarea>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column">
                <span class="glyphicon glyphicon-po" id="po"></span>
            </div>
        </div>
    </div>
</div>
<audio preload="none" src="" id="son"></audio>
<script type="text/javascript" src="./evenement.js"></script>
<script type="text/javascript" src="../js/bootstrap-switch.min.js"></script>
<script>
    $(document).ready(function () {
        $(".inputPosturePersonnage").bootstrapSwitch('state', false);
        affichagePersonnage("<?php echo $_SESSION['perso']; ?>");
        evenInputPersonnageChange("<?php echo $_SESSION['perso']; ?>", ".inputDescriptionPersonnage");
        verifJouerSon("<?php echo $_SESSION['perso']; ?>", dateNow(), "<?php echo $_SESSION['idSession']?>");
    });
</script>
</body>
</html>
