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

        if(func_num_args() > 2)
        {
            throw new Exception("Two args max must be give to this function.");
        }

        return $a + $b;
    }

    try{
        echo additionner(10, 3) . "<br />";
        echo additionner(2, 3, 4) . "<br />";
    }
    catch(MonException $e)
    {
        echo "[MonException] : " . $e;
    }
    catch(Exception $e)
    {
        echo "[Exception] : " . $e;
    }

    echo "<br />End.";