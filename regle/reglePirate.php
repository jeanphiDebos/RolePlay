<?php include("../model/header.php"); ?>
    <div id="Corps" class="regleJDR">
        Couleur drapeau bateau :
        Sans
        Pirate
        Espagnol
        Français
        Anglais
        Hollandais


        Dé de voyage (dé 10) :
        1 : Schooner commercial
        2 : rien, mer calme
        3 : rien, mer calme
        4 : rien, mer calme
        5 : Frigate (drapeau du même type)
        6 : Brig  (espagnol, français, anglais, Hollandais, Pirate)
        7 : Tempête (2 dé de dégàt tempête)
        8 : Frigate  (espagnol, français, anglais, Hollandais, Pirate)
        9 : Man of war (espagnol, français, anglais, Hollandais, Portugais)
        0 : grosse tempête (4 dé de dégàt tempête)


        Stat d’un bateau :
        Coque (vie)
        Canon (attaque)
        Voile (vitesse)
        Equipage


        Stat max du bateau:
        143 point a répartir
        Coque (vie, constitution) : (max 110)
        Canon (attaque, force) : (max 45)
        Voile (vitesse, dextérité) : (max 9)
        Equipage (mana): 50 (défini par les dé)


        Combat sur mer :
        Dé de dégât de tempête : 5 ou moins, 10 de dégât sur la coque (dé 10).
        Dé de drapeau: 1 et 2 Espagnol, 3 et 4 Français, 5 et 6 Anglais, 7 et 8 Hollandais, 9 et 0 Pirate ou Portugais (dé 10)
        Dé de début d’abordage (pour l’attaquant): perte d’équipage pendant l’attaque (dé 10)
        Dé de dégât des canons: 1 canon = 1 dégât sur la coque, produit en croix sur un dé 100 - 100 (ex d’un jet de 65 sur 50 canons: ((100-65)*50/100)*1 = 17)
        Dé d’abordage: 1 équipage = 0.25 dégât sur equipage, produit en croix sur un dé 100 - 100 (ex d’un jet de 30 sur 40 equipages: ((100-30)*40/100)/4 = 7)


        Cout des réparation et du recrutement :
        Réparation de la coque : 1 point de coque = 1 pièce d’or
        Recrutement de l'équipage : Un membre d'équipage recruté = 1 pièce d’or
    </div>
</body>
</html>