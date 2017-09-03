<?php
    class MonException extends Exception
    {
        public function __construct($message = "", $code = 0, Throwable $previous = null)
        {
            parent::__construct($message, $code, $previous);
        }

        public function __toString()
        {
            return $this->message;
        }
    }

    function additionner($a, $b)
    {
        if(!is_numeric($a) || !is_numeric($b))
        {
            // Lancement de l'exception
            throw new MonException('$a and $b must be numeric');
        }

        return $a + $b;
    }

    try{
        echo additionner(10, 3);
        echo additionner("lol", 3);
        echo additionner(3,4);
    }
    catch(MonException $e){
        echo $e;
    }

    echo "<br />End.";