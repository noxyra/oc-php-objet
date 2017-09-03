<?php
    function additionner($a, $b)
    {
        if(!is_numeric($a) || !is_numeric($b))
        {
            // Lancement de l'exception
            throw new Exception('$a and $b must be numeric');
        }

        return $a + $b;
    }

    try{
        echo additionner(12, 13) . '<br />';
        echo additionner("azerty", 54);
        echo additionner(4,8);
    }
    catch (Exception $e)
    {
        echo "Une exception a été lancé : " . $e->getMessage();
    }

    echo "<br />Fin du script.";
