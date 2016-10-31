    <div id="listeErreur">
        <?php if ($erreur != "") echo $erreur; ?>
    </div>
    <div id="enTete">
        <div id="versFichePersonnage" class="vers">
            <a id="lienVersFichePersonnage" class="lienVers" href="./index.php?perso=<?php echo $personnage; ?>&action=fichePerso">Retour à la fiche du perso</a>
        </div>
        <div id="versBestiaire" class="vers">
            <a id="lienVersBestiaire"  class="lienVers" href="../bestiaire/index.php">Voir la Bestiaire</a>
        </div>
        <div id="versCarte" class="vers">
            <a id="lienVersCarte" class="lienVers" href="../carte/index.php">Voir la Carte</a>
        </div>
        <div id="versLancerDes" class="vers">
            <a id="lienVersLancerDes" class="lienVers" href="../lancerDes/index.php">Dés Virtuel</a>
        </div>
    </div>
    <div id="Corps" class="listeMessages">
        <div class="row clearfix">
            <div class="col-md-4 column">
                <button type="button" id="sendMessageMJ">envoyer un message</button>
            </div>
        </div>
    </div>
    <audio preload="none" src="" id="son"></audio>
    <script type="text/javascript" src="./evenement.js"></script>
    <script>
        $(document).ready(function(){
            affichageMessages("<?php echo $personnage; ?>");
            allMessagesLue("<?php echo $personnage; ?>");
            evenButtonSendMessageMJClick("<?php echo $personnage; ?>");
            verifJouerSon("<?php echo $personnage; ?>", dateNow(), "<?php echo $_SESSION['idSession']?>");
        });
    </script>
</body>
</html>