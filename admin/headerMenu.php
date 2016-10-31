<div id="listeErreur">
    <?php if ($erreur != "") echo $erreur; ?>
</div>
<div id="enTete">
    <div id="versPerso" class="vers">
        <a id="lienVersPerso" class="lienVers" href="./index.php?action=fichePerso">Gestion des personnages</a>
    </div>
    <div id="messageDesJoueur" class="vers">
        <a id="lienVersMessage" class="lienVers" href="./index.php?action=listeMessage">
            <div id="messageNonLue"></div>
            <div id="voirMessage">Message des Joueurs</div>
        </a>
    </div>
    <div id="versCarte" class="vers">
        <a id="lienVersCarte" class="lienVers" href="./index.php?action=carte">Gestion des Cartes</a>
    </div>
    <div id="versBestiaire" class="vers">
        <a id="lienVersBestiaire" class="lienVers" href="./index.php?action=bestiaire">Gestion du Bestiaire</a>
    </div>
    <div id="versManagerSon" class="vers">
        <a id="lienVersManagerSon" class="lienVers" href="./index.php?action=JouerSon">Gestion des Sons</a>
    </div>
    <div id="versNavire" class="vers">
        <a id="lienVersNavire" class="lienVers" href="./index.php?action=navire">Gestion du Navire</a>
    </div>
</div>