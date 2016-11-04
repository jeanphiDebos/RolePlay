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
    <div class="row clearfix">
        <div class="col-md-12 column" id="carte"></div>
    </div>
</div>
<audio preload="none" src="" id="son"></audio>
<script type="text/javascript" src="./evenement.js"></script>
<script>
    var idCarte = "";
    $(document).ready(function () {
        $(window).resize(function () {
            redimensionnerCarte();
        });

        affichageCarte();
        <?php if (!empty($_SESSION['perso'])){ ?>verifJouerSon("<?php echo $_SESSION['perso']; ?>", dateNow(), "<?php echo $_SESSION['idSession']?>");
        <?php }else{ ?>verifJouerSon("0", dateNow(), "azerty123456789");<?php } ?>
    });
</script>
</body>
</html>