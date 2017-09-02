<?php
    // Attention !! Il faut qu'une classe soit abstraite pour y insérer des méthodes abstraites.

    abstract class Personnage{ // La classe Personnage est abstraite.
        abstract public function frapper(Personnage $personnage);

        public function recevoirDegats(){
            // Instructions...
        }
    }

    class Magicien extends  Personnage{ // Magicien hérite de la classe abstraite Personnage.
        // Nous sommes obligé d'écrire la fonction frapper pour le magicien.
        public function frapper(Personnage $personnage){
            // Instructions.
        }
    }

    $magicien = new Magicien; // Ok ça tourne.
