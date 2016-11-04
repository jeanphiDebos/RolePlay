<?php
if (isset($_FILES["file"]["type"]) && !empty($_POST['path'])) {
    if ($_FILES["file"]["error"] > 0) {
        echo $_FILES["file"]["error"];
    } else {
        $nameFormate = formatageElement($_FILES["file"]["name"]);
        if (file_exists($_POST['path'] . "/" . $nameFormate)) {
            echo $nameFormate . " exists";
        } else {
            $sourcePath = $_FILES['file']['tmp_name'];
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_POST['path'] . "/" . $nameFormate)) {
                echo json_encode($nameFormate);
            } else {
                echo "fail move_uploaded_file " . $_FILES['file']['tmp_name'] . " to " . $_POST['path'] . "/" . $nameFormate;
            }
        }
    }
} else {
    echo "file or post[past] not exists";
}

function formatageElement($nom)
{
    $nom = trim($nom);
    $nom = str_replace(array("á", "à", "ä", "â", "ª", "Á", "À", "Â", "Ä"), array("a", "a", "a", "a", "a", "A", "A", "A", "A"), $nom);
    $nom = str_replace(array("é", "è", "ë", "ê", "É", "È", "Ê", "Ë"), array("e", "e", "e", "e", "E", "E", "E", "E"), $nom);
    $nom = str_replace(array("í", "ì", "ï", "î", "Í", "Ì", "Ï", "Î"), array("i", "i", "i", "i", "I", "I", "I", "I"), $nom);
    $nom = str_replace(array("ó", "ò", "ö", "ô", "Ó", "Ò", "Ö", "Ô"), array("o", "o", "o", "o", "O", "O", "O", "O"), $nom);
    $nom = str_replace(array("ú", "ù", "ü", "û", "Ú", "Ù", "Û", "Ü"), array("u", "u", "u", "u", "U", "U", "U", "U"), $nom);
    $nom = str_replace(array("ñ", "Ñ", "ç", "Ç"), array("n", "N", "c", "C"), $nom);
    $nom = str_replace(array("\\", "¨", "º", "~", "#", "@", "|", "!", "\"", "·", "$", "%", "&", "/", "(", ")", "?", "'", "¡", "¿", "[", "^", "`", "]", "+", "}", "{", "¨", "´", ">", "< ", ";", ",", ":"), "", $nom);
    $nom = str_replace(array("-", "_"), " ", $nom);
    $nom = str_replace(" ", "_", $nom);
    $nom = strtolower($nom);

    return $nom;
}

?>