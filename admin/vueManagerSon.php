    <div id="Corps" class="managerSon">
        <div class="row clearfix listeAction">
            <div class="col-md-3 column">
                <div class="input-group">
                    <span class="input-group-addon">liste perso</span>
                    <select class="form-control" id="listePersonnage">
                        <option value="" class="defautValue" <?php if ($personnage == "" && !isset($_SESSION['perso'])){ ?>selected="selected"<?php } ?>>tout les personnages</option>
                        <?php foreach ($listePersonnages as $unPersonnages){ ?>
                            <option value="<?php echo $unPersonnages['id']; ?>" class="unPersonnageOption" <?php if (!empty($_SESSION['perso']) && $_SESSION['perso'] == $unPersonnages['id']){ ?>selected="selected"<?php } ?>><?php echo $unPersonnages['nom']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3 column">
                <div class="input-group">
                    <span class="input-group-addon">fichier Son</span>
                    <select class="form-control" id="CheminFichierSon"></select>
                </div>
            </div>
            <div class="col-md-3 column">
                <button id="playSon" class="btn btn-default">lancer son</button>
            </div>
            <div class="col-md-3 column">
                <?php include("../model/uploadFichier.php"); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="./evenementVueManagerSon.js"></script>
    <script type="text/javascript" src="./evenementVueListeMessage.js"></script>
    <script>
        $(document).ready(function(){
            evenButtonPlaySonClick();
            eventUploadFichier("#CheminFichierSon", "sonOption");
            affichageListeSon("<?php echo $pathUploadFichier; ?>");
            affichageNombreMessageJoueurNonLue();
        });
    </script>
</body>
</html>