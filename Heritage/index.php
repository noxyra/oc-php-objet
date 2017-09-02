<?php
    // Résolution statique à la volée
    class Mere{
        public static function lancerLeTest(){
            self::quiEstCe();
        }

        public static function quiEstCe()
        {
            echo "Je suis la classe mère";
        }
    }

    class Enfant extends Mere{
        public static function quiEstCe()
        {
            echo "Je suis la classe enfant";
        }
    }

    // Va afficher : je suis la classe mère. car self:: fait appel à la methode statique de la classe ou elle est contenu. lancerLeTest est dans la classe mère, donc c'est le quiEstCe de la classe mère qui sera lancé.
    // Pour afficher je suis la classe enfant, il faut remplacer self:: par static:: à la ligne 5
    Enfant::lancerLeTest();
