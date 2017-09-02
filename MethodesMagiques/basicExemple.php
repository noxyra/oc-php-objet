<?php

    class MaClasse{

        private $attributs = [];
        private  $unAttributPrive;

        // Construct est une méthode magique. Elle correspond à l'événement de création de l'objet.
        public function __construct()
        {
            //...
        }

        // Destruct est aussi une méthode magique. Elle sera executé au moment ou l'on détruit l'objet.
        public function __destruct()
        {
            //...
        }

        // EXP Après cette ligne 6 méthodes magiques utiles vont être écrites.

        // La methode __set()
        // Cette methode est appellé lorsqu'on tente d'assiger une valeur à un atribut protégé ou inexistant.
        public function __set($name, $value)
        {
            echo 'Ah, on a tenté d\'assigner à l\'attribut <strong>', $name, '</strong> la valeur <strong>', $value, '</strong> mais c\'est pas possible !<br />';
        }

        // La methode __get()
        // Sensiblement identique à la gethode __set() celle ci se déclanche lorsqu'on veut simplement accéder à une méthode inexistante ou protégée.
        public function __get($name)
        {
            echo 'Vous avez tenté d\'accéder à l\'attribut '. $name .' c\'est impossible';
        }

        // La methode __isset()
        // Cette méthode doit renvoyer un booleen  et correspond à un appel de la fonction isset().
        public function __isset($name)
        {
            // Ex :
            return isset($this->attributs[$name]);
        }

        // La methode __unset()
        // Cette méthode ne renvoie rien. Et correspond à un appel de unset()
        public function __unset($name)
        {
            if (isset($this->attributs[$name]))
            {
                unset($this->attributs[$name]);
            }
        }

        // La methode __call()
        // Cette méthode est utilisé quand on appelle une methode qui n'existe pas.
        public function __call($name, $arguments)
        {
            echo 'La méthode <strong>', $name, '</strong> a été appelée alors qu\'elle n\'existe pas ! Ses arguments étaient les suivants : <strong>', implode ($arguments, '</strong>, <strong>'), '</strong><br />';
        }

        // La methode __callStatic()
        // Cette méthode est utilisé quand on appelle une methode statique qui n'existe pas.
        public static function __callStatic($name, $arguments){
            echo 'La méthode <strong>', $name, '</strong> a été appelée dans un contexte statique alors qu\'elle n\'existe pas ! Ses arguments étaient les suivants : <strong>', implode ($arguments, '</strong>, <strong>'), '</strong><br />';
        }
    }