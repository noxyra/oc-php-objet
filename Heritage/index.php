<?php
    abstract class Personnage{

        // Methode standard
        public function frapper(Personnage $personnage){
            // ...
        }

        // Methode finale
        final public function recevoirDegats(){
            // ...
        }
    }

    class Guerrier extends Personnage{
        // Ca va fonctionner
        public function frapper(Personnage $personnage){
            // ...
        }

        // Fatal error, on ne peut pas réecrire une classe finale.
        public function recevoirDegats(){
            // ...
        }
    }
