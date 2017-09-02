<?php
    class Personnage{
        // Variables
        private $_id;
        private $_degats;
        private $_nom;

        // Constantes
        const CEST_MOI = 1;
        const PERSONNAGE_TUE = 2;
        const PERSONNAGE_FRAPPE = 3;

        // Getters
        public function getId(){
            return $this->_id;
        }

        public function getDegats(){
            return $this->_degats;
        }

        public function getNom(){
            return $this->_nom;
        }

        // Setters
        public function setId($id){
            $id = (int) $id;
            $this->_id = $id;
        }

        public function setDegats($degats){
            $degats = (int) $degats;
            if ($degats >= 0 && $degats <= 100){
                $this->_degats = $degats;
            }
        }

        public function setNom($nom){
            if(is_string($nom)){
                $this->_nom = $nom;
            }
        }

        // Construction
        public function __construct(array $donnees)
        {
            $this->hydrate($donnees);
        }

        // Hydratation
        public function hydrate(array $donnees){
            foreach ($donnees as $k => $v){
                $method = "set" . ucfirst($k);
                if(method_exists($this, $method)){
                    $this->$method($v);
                }
            }
        }

        // Methode d'actions

        public function frapper(Personnage $personnage){
            if($this->getId() === $personnage->getId()){
                self::CEST_MOI;
            }

            return $personnage->recevoirDegats();
        }

        public function recevoirDegats(){
            $this->_degats = $this->_degats + 5;

            if($this->_degats >= 100){
                return self::PERSONNAGE_TUE;
            }

            return self::PERSONNAGE_FRAPPE;
        }

        public function nomValide()
        {
            return !empty($this->_nom);
        }
    }