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
        public function add(Personnage $personnage){
            $query = $this->_db->prepare("INSERT INTO personnages(nom) VALUES(:nom)");
            $query->bindValue(":nom", $personnage->getNom());
            $query->execute();

            $personnage->hydrate([
               "id" => $this->_db->lastInsertId(),
               "degats" => 0
            ]);
        }

        // Compter les personnages
        public function count(){
            return $this->_db->query("SELECT COUNT(*) FROM personnages")->fetchColumn();
        }

        // Modification d'un personnage
        public function update(Personnage $personnage){
            $query = $this->_db->prepare("UPDATE personnages SET degats = :degats WHERE id = :id");
            $query->bindValue(":degats", $personnage->getDegats());
            $query->bindValue(":id", $personnage->getId(), PDO::PARAM_INT);
            $query->execute();
        }

        // Suppression d'un personnage
        public function delete(Personnage $personnage){
            $this->_db->exec("DELETE FROM personnages WHERE id = " . $personnage->getId());
        }

        // Récupération d'un personnage
        public function get($info){
            if(is_int($info)){
                // On récupère par l'ID
                $query = $this->_db->query("SELECT * FROM personnages WHERE id = ".$info);
            }
            else{
                // On récupère par le nom
                $query = $this->_db->prepare("SELECT * FROM personnages WHERE nom = :nom");
                $query->execute([":nom" => $info]);
            }
            $donnees = $query->fetch(PDO::FETCH_ASSOC);
            return new Personnage($donnees);
        }

        // Récupération de la liste des personnages dont le nom n'est pas $nom
        public function getList($nom){
            $personnages = [];

            $query = $this->_db->prepare("SELECT * FROM personnages WHERE nom <> :nom ORDER BY nom");
            $query->execute([":nom" => $nom]);

            while ($donnees = $query->fetch(PDO::FETCH_ASSOC)){
                $personnages[] = new Personnage($donnees);
            }

            return $personnages;
        }

        // Vérifier l'existance d'un personnage
        public function exists($info)
        {
            if (is_int($info)){
                return (bool) $this->_db->query('SELECT COUNT(*) FROM personnages WHERE id = '.$info)->fetchColumn();
            }

            $q = $this->_db->prepare('SELECT COUNT(*) FROM personnages WHERE nom = :nom');
            $q->execute([':nom' => $info]);

            return (bool) $q->fetchColumn();
        }
    }