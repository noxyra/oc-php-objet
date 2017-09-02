<?php
    class ClasseMere{
        protected $attributProtege;
        private $_attributPrive;

        public function __construct()
        {
            $this->attributProtege = "Salut, je suis protégée.";
            $this->_attributPrive = "Salut, je suis privée.";
        }
    }

    class ClasseFille extends ClasseMere{
        public function afficherAttributs()
        {
            echo $this->attributProtege;
            echo $this->_attributPrive; // Ceci affichera une notice (si activé), car nous n'y avons pas accès depuis la classe Fille.
        }
    }

    $obj = new ClasseFille;

    echo $obj->attibutProtege; // Fatal Error.
    echo $obj->_attributPrive; // Affiche une notice (si activé)

    echo $obj->afficherAttributs(); // Affiche seulement "Salut, je suis protégée." & une notice (si activé)