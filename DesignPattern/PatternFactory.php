<?php

    /**
     * Class DBFactory
     *
     * Représente le pattern factory.
     */
    class DBFactory
    {
        public static function load($sgbdr)
        {
            $classe = "SGBDR_" . $sgbdr;

            if(file_exists($chemin = $classe . ".class.php"))
            {
                require $chemin;
                return new $classe;
            }
            else
            {
                throw new RuntimeException("La classe <strong>" . $classe . "</strong> n\'a pu être trouvée !");
            }
        }
    }

    // Exemple d'utilisation :

    try
    {
        $mysql = DBFactory::load("MySQL");
    }
    catch (RuntimeException $e)
    {
        echo $e->getMessage();
    }

    // Exemple concret avec PDO
    class PDOFactory
    {
        public static function getMysqlConnexion()
        {
            $db = new PDO("mysql:host=localhost;dbname=tests", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        }

        public static function getPgsqlConnexion()
        {
            $db = new PDO("pgsql:host=localhost;dbname=tests", "root", "");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        }
    }

    // TESTS
    class ErrorHandler implements SplSubject
    {
        // Ceci est le tableau qui va contenir tous les objets qui nous observent.
        protected $observers = [];

        // Attribut qui va contenir notre erreur formatée.
        protected $formatedError;

        public function attach(SplObserver $observer)
        {
            $this->observers[] = $observer;
            return $this;
        }

        public function detach(SplObserver $observer)
        {
            if (is_int($key = array_search($observer, $this->observers, true)))
            {
                unset($this->observers[$key]);
            }
        }

        public function getFormatedError()
        {
            return $this->formatedError;
        }

        public function notify()
        {
            foreach ($this->observers as $observer)
            {
                $observer->update($this);
            }
        }

        public function error($errno, $errstr, $errfile, $errline)
        {
            $this->formatedError = '[' . $errno . '] ' . $errstr . "\n" . 'Fichier : ' . $errfile . ' (ligne ' . $errline . ')';
            $this->notify();
        }
    }

    $o = new ErrorHandler;

    $db = PDOFactory::getMysqlConnexion();

    $o->attach(new MailSender("login@fai.tld"))
        ->attach(new BDDWriter($db));

    set_error_handler([$o, "error"]);

    5/0; // Génération d'une erreur.