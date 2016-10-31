    <div id="Corps" class="adminCarte">
        <div class="row clearfix listeAction">
            <div class="col-md-2 column">
                <div class="input-group">
                    <span class="input-group-addon">liste carte</span>
                    <select class="form-control" id="listeCarte">
                        <option value="" class="defautValue" <?php if ($carte == "" && !isset($_SESSION['carte'])){ ?>selected="selected"<?php } ?>>selectionner une carte</option>
                        <?php foreach ($listeCartes as $uneCarte){ ?>
                            <option value="<?php echo $uneCarte['id']; ?>" class="uneCarteOption" <?php if (isset($_SESSION['carte']) && $_SESSION['carte'] == $uneCarte['id']){ ?>selected="selected"<?php } ?>><?php echo $uneCarte['nom']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 column">
                <button type="button" id="addCarte" class="btn btn-default">ajouter une carte</button>
            </div>
            <div class="col-md-2 column">
                <div class="input-group">
                    <span class="input-group-addon">axeVertical</span>
                    <input type="text" class="form-control" id="axeVertical">
                </div>
            </div>
            <div class="col-md-2 column">
                <div class="input-group">
                    <span class="input-group-addon">axeHorizontal</span>
                    <input type="text" class="form-control" id="axeHorizontal">
                </div>
            </div>
            <div class="col-md-2 column">
                <div class="input-group">
                    <span class="input-group-addon">type affichage</span>
                    <select class="form-control" id="typeAffichage">
                        <option value="cacher" id="cacher">cacher</option>
                        <option value="mapper" id="mapper">mapper</option>
                        <option value="visible" id="visible">visible</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1 column">
                <input type="checkbox" id="activerAfficher" data-on-color="success" data-off-color="danger" data-label-text="Appel">
            </div>
            <div class="col-md-1 column">
                <?php include("../model/uploadFichier.php"); ?>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column" id="carte"></div>
        </div>
    </div>
    <script type="text/javascript" src="./evenementVueCarte.js"></script>
    <script type="text/javascript" src="./evenementVueListeMessage.js"></script>
    <script type="text/javascript" src="../js/bootstrap-switch.min.js"></script>
    <script>
        $(document).ready(function(){
            var IDCarte = "<?php if (isset($_SESSION['carte'])){ echo $_SESSION['carte']; }?>";

            $( window ).resize(function() {
                redimensionnerCarte();
            });

            $("#activerAfficher").bootstrapSwitch('state', false);
            evenButtonAddCarteClick("<?php echo $pathUploadFichier; ?>");
            evenSelectCarteChange();
            eventUploadFichier("#imageCarte", "carteOption");
            affichageNombreMessageJoueurNonLue();

            if (IDCarte != ""){
                affichageCarte(IDCarte);
            }
        });
    </script>
</body>
</html>