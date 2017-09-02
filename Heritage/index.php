<?php
    abstract class Personnage{ // La classe Personnage est abstraite.

    }

    class Magicien extends  Personnage{ // Magicien hérite de la classe abstraite Personnage.

    }

    $magicien = new Magicien; // Ok ça tourne.
    $perso = new Personnage; // Fatal error la classe est abstraite nous pouvons pas l'instancier directement.