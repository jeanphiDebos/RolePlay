<div id="listeErreur">
    <?php if ($erreur != "") echo $erreur; ?>
</div>
<div id="enTete">
    <?php if (!empty($_SESSION['perso'])) { ?>
        <div id="versFichePersonnage" class="vers">
            <a id="lienVersFichePersonnage" class="lienVers"
               href="../personnage/index.php?perso=<?php echo $_SESSION['perso']; ?>">Retour à la fiche du perso</a>
        </div>
    <?php } ?>
</div>
<div id="Corps">
    <div id="listeBestiaire" class="row clearfix">
    </div>
</div>
<audio preload="none" src="" id="son"></audio>
<script type="text/javascript" src="./evenement.js"></script>
<script>
    $(document).ready(function () {
        affichageBestiaire();
        <?php if (!empty($_SESSION['perso'])){ ?>verifJouerSon("<?php echo $_SESSION['perso']; ?>", dateNow(), "<?php echo $_SESSION['idSession']?>");<?php } ?>
    });
</script>
</body>
</html>