<?php include("../model/header.php"); ?>
    <div id="Corps" class="regleJDR">
        <h1>Règle JDR Pirate</h1>
        <p>
            <h2>Couleur drapeau bateau :</h2>
            <ul>
                <li>Sans</li>
                <li>Pirate</li>
                <li>Espagnol</li>
                <li>Français</li>
                <li> Anglais</li>
                <li> Hollandais</li>
            </ul>
        </p>
        <p>
            <h2>Dé de voyage (dé 10) :</h2>
            <ul>
                <li>1 : Schooner commercial</li>
                <li>2 : rien, mer calme</li>
                <li>3 : rien, mer calme</li>
                <li>4 : rien, mer calme</li>
                <li>5 : Frigate (drapeau du même type)</li>
                <li>6 : Brig  (espagnol, français, anglais, Hollandais, Pirate)</li>
                <li>7 : Tempête (2 dé de dégàt tempête)</li>
                <li>8 : Frigate  (espagnol, français, anglais, Hollandais, Pirate)</li>
                <li>9 : Man of war (espagnol, français, anglais, Hollandais, Portugais)</li>
                <li>0 : grosse tempête (4 dé de dégàt tempête)</li>
            </ul>
        </p>
        <p>
            <h2>Stat d’un bateau :</h2>
            <ul>
                <li>Coque (vie)</li>
                <li>Canon (attaque)</li>
                <li>Voile (vitesse)</li>
                <li>Equipage</li>
            </ul>
        </p>
        <p>
            <h2>Stat max du bateau:</h2>
            <ul>
                <li>143 point a répartir</li>
                <li>Coque (vie, constitution) : (max 110)</li>
                <li>Canon (attaque, force) : (max 45)</li>
                <li>Voile (vitesse, dextérité) : (max 9)</li>
                <li>Equipage (mana): 50 (défini par les dé)</li>
            </ul>
        </p>
        <p>
            <h2>Combat sur mer :</h2>
            <ul>
                <li>Dé de dégât de tempête : 5 ou moins, 10 de dégât sur la coque (dé 10).</li>
                <li>Dé de drapeau: 1 et 2 Espagnol, 3 et 4 Français, 5 et 6 Anglais, 7 et 8 Hollandais, 9 et 0 Pirate ou Portugais (dé 10)</li>
                <li>Dé de début d’abordage (pour l’attaquant): perte d’équipage pendant l’attaque (dé 10)</li>
                <li>Dé de dégât des canons: 1 canon = 1 dégât sur la coque, produit en croix sur un dé 100 - 100 (ex d’un jet de 65 sur 50 canons: ((100-65)*50/100)*1 = 17)</li>
                <li>Dé d’abordage: 1 équipage = 0.25 dégât sur equipage, produit en croix sur un dé 100 - 100 (ex d’un jet de 30 sur 40 equipages: ((100-30)*40/100)/4 = 7)</li>
            </ul>
        </p>
        <p>
            <h2>Cout des réparation et du recrutement :</h2>
            <ul>
                <li>Réparation de la coque : 1 point de coque = 1 pièce d’or</li>
                <li>Recrutement de l'équipage : Un membre d'équipage recruté = 1 pièce d’or</li>
            </ul>
        </p>
    </div>
</body>
</html>