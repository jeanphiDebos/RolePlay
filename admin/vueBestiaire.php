<div id="Corps" class="ficheMonstre">
    <div class="row clearfix listeAction">
        <div class="col-md-4 column">
            <div class="input-group">
                <span class="input-group-addon">liste Monstres</span>
                <select class="form-control" id="listeMonstres">
                    <option value="" class="defautValue"
                            <?php if (empty($_SESSION['monstre'])){ ?>selected="selected"<?php } ?>>selectionner un
                        Monstre
                    </option>
                    <?php foreach ($listeBestiaire as $unMonstre) { ?>
                        <option value="<?php echo $unMonstre['id']; ?>" class="unMonstreOption"
                            <?php if (!empty($_SESSION['monstre']) && $_SESSION['monstre'] == $unMonstre['id']){ ?>selected="selected"<?php } ?>><?php echo $unMonstre['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2 column">
            <button type="button" id="addMonstre" class="btn btn-default">ajouter un Monstre</button>
        </div>
        <div class="col-md-2 column">
            <button type="button" id="deletMonstre" class="btn btn-default">supprimer le Monstre</button>
        </div>
        <div class="col-md-2 column">
            <?php include("../model/uploadFichier.php"); ?>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-3 column glyphicon glyphicon-nom">
            <input type="text" name="nom" id="nom" class="inputDescriptionMonstre"></div>
        <div class="col-md-3 column glyphicon glyphicon-image">
            <select class="inputDescriptionMonstre" id="imageMonstre" name="image">
                <option value="" class="imageMonstreOption">noImage</option>
            </select>
        </div>
        <div class="col-md-2 column glyphicon glyphicon-lvl">
            <input type="number" name="lvl" id="lvl" class="inputDescriptionMonstre"></div>
        <div class="col-md-2 column glyphicon glyphicon-vie">
            <input type="number" name="vie" id="vie" class="inputDescriptionMonstre"></div>
        <div class="col-md-2 column glyphicon glyphicon-isCacher">
            <input type="checkbox" name="isCacher" id="isCacher" class="inputCacheMonstre" data-on-color="success"
                   data-off-color="danger" data-label-text="Cacher">
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-3 column glyphicon glyphicon-attaque">
            <input type="number" name="attaque" min="0" max="100" id="attaque" class="inputDescriptionMonstre">
        </div>
        <div class="col-md-3 column glyphicon glyphicon-bonusDegat">
            <input type="text" name="bonusDegat" id="bonusDegat" class="inputDescriptionMonstre"></div>
        <div class="col-md-3 column glyphicon glyphicon-reductionDegat">
            <input type="number" name="reductionDegat" id="reductionDegat" class="inputDescriptionMonstre"></div>
        <div class="col-md-3 column glyphicon glyphicon-sort">
            <input type="text" name="sort" id="sort" class="inputDescriptionMonstre"></div>
    </div>
    <div class="row clearfix">
        <div class="col-md-3 column glyphicon glyphicon-parade">
            <input type="number" name="parade" min="0" max="100" id="parade" class="inputDescriptionMonstre">
        </div>
        <div class="col-md-3 column glyphicon glyphicon-esquive">
            <input type="number" name="esquive" min="0" max="100" id="esquive" class="inputDescriptionMonstre">
        </div>
        <div class="col-md-3 column glyphicon glyphicon-blocage">
            <input type="number" name="blocage" min="0" max="100" id="blocage" class="inputDescriptionMonstre">
        </div>
        <div class="col-md-3 column glyphicon glyphicon-contreAttaque">
            <input type="number" name="contreAttaque" min="0" max="100" id="contreAttaque"
                   class="inputDescriptionMonstre">
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-6 column glyphicon glyphicon-force">
            <input type="text" name="force" id="force" class="inputDescriptionMonstre"></div>
        <div class="col-md-6 column glyphicon glyphicon-faiblesse">
            <input type="text" name="faiblesse" id="faiblesse" class="inputDescriptionMonstre"></div>
    </div>
</div>
<script type="text/javascript" src="./evenementVueBestiaire.js"></script>
<script type="text/javascript" src="./evenementVueListeMessage.js"></script>
<script type="text/javascript" src="../js/bootstrap-switch.min.js"></script>
<script>
    $(document).ready(function () {
        var idMonstre = "<?php if (isset($_SESSION['monstre'])) {
            echo $_SESSION['monstre'];
        }?>";

        $("#isCacher").bootstrapSwitch('state', false);
        evenSelectListeMonstreChange("#listeMonstres");
        evenButtonAddMonstreClick("#addMonstre");
        eventUploadFichier("#imageMonstre", "carteOption");
        affichageImageMonstre(idMonstre, "<?php echo $pathUploadFichier; ?>");
        affichageNombreMessageJoueurNonLue();
    });
</script>
</body>
</html>