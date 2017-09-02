<?php
    class PersonnageManager{
        // Variables
        private $_db;

        // Constructeur
        public function __construct($db){
            $this->setDb($db);
        }

        public function setDb(PDO $db){
            $this->_db = $db;
        }

        // Enregistrement d'un personnage
        public function add(Personnage $personnage){}

        // Modification d'un personnage
        public function edit(Personnage $personnage){}

        // Suppression d'un personnage
        public function delete(Personnage $personnage){}

        // Récupération d'un personnage
        public function get(Personnage $personnage){}

        // Compter les personnages
        public function count(){}
    }