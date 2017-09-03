<?php
    class Observee implements SplSubject
    {
        protected $observers = [];
        protected $formatedError;
        protected $nom;

        public function attach(SplObserver $observer)
        {
            $this->observers[] = $observer;
        }

        public function detach(SplObserver $observer)
        {
            if(is_int($key = array_search($observer, $this->observers, true)))
            {
                unset($this->observers[$key]);
            }
        }

        public function notify()
        {
            foreach ($this->observers as $observer)
            {
                $observer->update($this);
            }
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function setNom($nom)
        {
            $this->nom = $nom;
            $this->notify();
        }

        public function error($errno, $errstr, $errfile, $errline)
        {
            $this->formatedError = '[' . $errno . '] ' . $errstr . "\n" . 'Fichier : ' . $errfile . ' (ligne ' . $errline . ')';
            $this->notify();
        }
    }

    class Observer1 implements SplObserver
    {
        public function update(SplSubject $obj)
        {
            echo "Observer1 a été notifié ! Nouvelle valeur de l'attribut <strong>nom</strong> : " . $obj->getNom();
        }
    }

    class Observer2 implements SplObserver
    {
        public function update(SplSubject $obj)
        {
            echo "Observer2 a été notifié ! Nouvelle valeur de l'attribut <strong>nom</strong> : " . $obj->getNom();
        }
    }

    $o = new Observee;
    $o->attach(new Observer1);
    $o->attach(new Observer2);
    $o->setNom("Victor");

    // Classe s'occupant d'envoyer des mails
    class MailSender implements SplObserver
    {
        protected $mail;

        public function __construct($mail)
        {
            if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail))
            {
                $this->mail = $mail;
            }
        }

        public function update(SplSubject $subject)
        {
            mail($this->mail, 'Erreur détectée !', 'Une erreur a été détectée sur le site. Voici les informations de celle-ci : ' . "\n" . $subject->getFormatedError());
        }
    }

    // Classe s'occupant d'écrire dans la BDD
    class BDDWriter implements SplObserver
    {
        protected $db;

        public function __construct(PDO $db)
        {
            $this->db = $db;
        }

        public function update(SplSubject $subject)
        {
            $q = $this->db->prepare("INSERT INTO erreurs SET erreur = :erreur");
            $q->bindValue(":erreur", $subject->getFormatedError());
            $q->execute();
        }
    }