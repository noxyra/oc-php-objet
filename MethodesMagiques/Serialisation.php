<?php
class Connexion
{
    protected $pdo, $serveur, $utilisateur, $motDePasse, $dataBase;

    public function __construct($serveur, $utilisateur, $motDePasse, $dataBase)
    {
        $this->serveur = $serveur;
        $this->utilisateur = $utilisateur;
        $this->motDePasse = $motDePasse;
        $this->dataBase = $dataBase;

        $this->connexionBDD();
    }

    protected function connexionBDD()
    {
        $this->pdo = new PDO('mysql:host='.$this->serveur.';dbname='.$this->dataBase, $this->utilisateur, $this->motDePasse);
    }

    public function __sleep()
    {
        return ['serveur', 'utilisateur', 'motDePasse', 'dataBase'];
    }

    public function __wakeup()
    {
        $this->connexionBDD();
    }
}
