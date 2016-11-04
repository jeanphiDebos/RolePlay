<div id="Corps" class="listeMessages">
    <?php foreach ($listeMessage as $unMessage) { ?>
        <div class="row clearfix">
            <div class="col-md-10 column textUnMessage"><?php echo $unMessage['message'] ?></div>
            <div class="col-md-2 column dateUnMessage"><?php echo $unMessage['dateCreaction'] ?></div>
        </div>
        <hr>
    <?php } ?>
</div>
<script type="text/javascript" src="./evenementVueListeMessage.js"></script>
<script>
    $(document).ready(function () {
        allMessagesLue();
    });
</script>
</body>
</html>