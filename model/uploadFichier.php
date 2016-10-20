<form id="uploadFichier" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="path" id="path" value="<?php echo $pathUploadFichier; ?>"/>
    <input type="file" name="file" id="file" required/>
    <div class="overTextFileInput">upload un fichier</div>
</form>