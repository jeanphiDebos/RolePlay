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
    <div id="Corps">
        <div id="listeBestiaire" class="row clearfix">
        </div>
    </div>
    <script type="text/javascript" src="./evenement.js"></script>
    <script>
        var idCarte = "";
        $(document).ready(function(){
            affichageBestiaire();
        });
    </script>
</body>
</html>