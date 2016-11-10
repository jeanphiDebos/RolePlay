<div id="listeErreur">
    <?php if ($erreur != "") echo $erreur; ?>
</div>
<div id="enTete"></div>
<div id="Corps">
    <div class="row clearfix">
        <div class="col-md-4 column">
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-nom" id="nom"></div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 column" id="image"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-coque" id="coque"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-equipage" id="equipage"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-canon" id="canon"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-bouletCanon" id="bouletCanon"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-voile" id="voile"></div>
            </div>
        </div>
        <div class="col-md-4 column">
            
        </div>
        <div class="col-md-4 column">
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-nom" id="nomAdverse"></div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 column" id="imageAdverse"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-coque" id="coqueAdverse"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-equipage" id="equipageAdverse"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-canon" id="canonAdverse"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-bouletCanon" id="bouletCanonAdverse"></div>
            </div>
            <hr>
            <div class="row clearfix">
                <div class="col-md-12 column glyphicon glyphicon-voile" id="voileAdverse"></div>
            </div>
        </div>
    </div>
</div>
<audio preload="none" src="" id="son"></audio>
<script type="text/javascript" src="./evenement.js"></script>
<script>
    $(document).ready(function () {
        verifJouerSon("0", dateNow(), "azerty123456789");
    });
</script>
</body>
</html>