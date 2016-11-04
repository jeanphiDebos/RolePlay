<div id="Corps" class="fichePersonnage">
    <div class="row clearfix listeAction">
        <div class="col-md-4 column">
            <div class="input-group">
                <span class="input-group-addon">liste perso</span>
                <select class="form-control" id="listePersonnage">
                    <option value="" class="defautValue"
                            <?php if (empty($_SESSION['perso'])){ ?>selected="selected"<?php } ?>>selectionner un perso
                    </option>
                    <?php foreach ($listePersonnages as $unPersonnages) { ?>
                        <option value="<?php echo $unPersonnages['id']; ?>" class="unPersonnageOption"
                            <?php if (!empty($_SESSION['perso']) && $_SESSION['perso'] == $unPersonnages['id']){ ?>selected="selected"<?php } ?>><?php echo $unPersonnages['nom']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-2 column">
            <button type="button" id="addPersonnage" class="btn btn-default">ajouter un perso</button>
        </div>
        <div class="col-md-2 column">
            <button type="button" id="deletPersonnage" class="btn btn-default">supprimer le perso</button>
        </div>
        <div class="col-md-4 column">
            <button type="button" id="sendMessagePersonnage" class="btn btn-default">envoyer un message</button>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-2 column glyphicon glyphicon-lvl">
            <input type="number" name="lvl" id="lvl" class="inputDescriptionPersonnage"></div>
        <div class="col-md-3 column glyphicon glyphicon-classe">
            <input type="text" name="classe" id="classe" class="inputDescriptionPersonnage"></div>
        <div class="col-md-3 column glyphicon glyphicon-metier">
            <input type="text" name="metier" id="metier" class="inputDescriptionPersonnage"></div>
        <div class="col-md-2 column glyphicon glyphicon-vie">
            <input type="number" name="vie" id="vie" class="inputDescriptionPersonnage"></div>
        <div class="col-md-2 column glyphicon glyphicon-mana">
            <input type="number" name="mana" id="mana" class="inputDescriptionPersonnage"></div>
    </div>
    <div class="row clearfix">
        <div class="col-md-2 column glyphicon glyphicon-force">
            <input type="number" name="force" id="force" class="inputDescriptionPersonnage">
        </div>
        <div class="col-md-2 column glyphicon glyphicon-education">
            <input type="number" name="education" id="education" class="inputDescriptionPersonnage">
        </div>
        <div class="col-md-2 column glyphicon glyphicon-dexterite">
            <input type="number" name="dexterite" id="dexterite" class="inputDescriptionPersonnage">
        </div>
        <div class="col-md-2 column glyphicon glyphicon-perception">
            <input type="number" name="perception" id="perception" class="inputDescriptionPersonnage">
        </div>
        <div class="col-md-2 column glyphicon glyphicon-constitution">
            <input type="number" name="constitution" id="constitution" class="inputDescriptionPersonnage">
        </div>
        <div class="col-md-1 column glyphicon glyphicon-charisme">
            <input type="number" name="charisme" id="charisme" class="inputDescriptionPersonnage">
        </div>
        <div class="col-md-1 column glyphicon glyphicon-chance">
            <input type="number" name="chance" id="chance" class="inputDescriptionPersonnage">
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-md-4 column glyphicon glyphicon-competence">
            <textarea name="competence" id="competence" class="inputDescriptionPersonnage"></textarea></div>
        <div class="col-md-4 column glyphicon glyphicon-sort">
            <textarea name="sort" id="sort" class="inputDescriptionPersonnage"></textarea></div>
        <div class="col-md-4 column glyphicon glyphicon-equipement ">
            <textarea name="equipement" id="equipement" class="inputDescriptionPersonnage"></textarea></div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12 column glyphicon glyphicon-inventaire">
            <textarea name="inventaire" id="inventaire" class="inputDescriptionPersonnage"></textarea></div>
    </div>
    <div class="row clearfix">
        <div class="col-md-12 column glyphicon glyphicon-po"><input type="number" name="po" id="po"></div>
    </div>
</div>
<script type="text/javascript" src="./evenementVuePersonnage.js"></script>
<script type="text/javascript" src="./evenementVueListeMessage.js"></script>
<script>
    $(document).ready(function () {
        var idPersonnage = "<?php if (isset($_SESSION['perso'])) {
            echo $_SESSION['perso'];
        }?>";

        affichagePersonnage(idPersonnage);
        evenSelectListePersonnageChange("#listePersonnage");
        evenButtonAddPersonnageClick("#addPersonnage");
        affichageNombreMessageJoueurNonLue();
    });
</script>
</body>
</html>