<?php
    // Nous rendons la classe personnage impossible à instancier.
    abstract class Personnage{
        // Variables
        protected   $atout,
                    $degats,
                    $id,
                    $nom,
                    $timeEndormi,
                    $type;

        // Constantes
        const CEST_MOI = 1;
        const PERSONNAGE_TUE = 2;
        const PERSONNAGE_FRAPPE = 3;
        const PERSONNAGE_ENSORCELE = 4;
        const PAS_DE_MAGIE = 5;
        const PERSO_ENDORMI = 6;

        // Getters
        public function getId(){ return $this->id; }
        public function getDegats(){ return $this->degats; }
        public function getNom(){ return $this->nom; }
        public function getAtout(){ return $this->atout; }
        public function getTimeEndormi(){ return $this->timeEndormi; }
        public function getType(){ return $this->type; }

        // Setters
        public function setId($id){
            $id = (int) $id;
            $this->id = $id;
        }

        public function setDegats($degats){
            $degats = (int) $degats;
            if ($degats >= 0 && $degats <= 100){
                $this->degats = $degats;
            }
        }

        public function setNom($nom){
            if(is_string($nom)){
                $this->nom = $nom;
            }
        }

        public function setAtout($atout)
        {
            $atout = (int) $atout;

            $this->atout = $atout;
        }

        public function setTimeEndormi($timeEndormi)
        {
            $timeEndormi = (int) $timeEndormi;

            $this->timeEndormi = $timeEndormi;
        }

        // Construction
        public function __construct(array $donnees)
        {
            $this->hydrate($donnees);
            $this->type = strtolower(static::class);
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

        public function recevoirDegats($degats = null){

            if($degats === null){
                $this->degats = $this->degats + 5;
            }
            else{
                $this->degats = (int) $degats;
            }

            if($this->degats >= 100){
                return self::PERSONNAGE_TUE;
            }

            return self::PERSONNAGE_FRAPPE;
        }

        public function nomValide()
        {
            return !empty($this->nom);
        }
    }