<div id="listeErreur">
    <?php if ($erreur != "") echo $erreur; ?>
</div>
<div id="enTete">
    <div id="versPerso">
        <a id="lienVersPerso" href="./index.php?action=fichePerso">Gestion des personnages</a>
    </div>
    <div id="messageDesJoueur">
        <a id="lienVersMessage" href="./index.php?action=listeMessage">
            <div id="messageNonLue"></div>
            <div id="voirMessage">Message des Joueurs</div>
        </a>
    </div>
    <div id="versCarte">
        <a id="lienVersCarte" href="./index.php?action=carte">Gestion des Cartes</a>
    </div>
    <div id="versBestiaire">
        <a id="lienVersBestiaire" href="./index.php?action=bestiaire">Gestion du Bestiaire</a>
    </div>
    <div id="versManagerSon">
        <a id="lienVersManagerSon" href="./index.php?action=JouerSon">Gestion des Sons</a>
    </div>
</div>