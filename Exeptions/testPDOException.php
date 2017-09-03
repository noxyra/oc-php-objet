<?php
    try{
        $db = new PDO('mysql:host=localhost;dbname=tests', 'root', 'kiki');
        echo "Connexion reussie !";
    }
    catch(PDOException $e){
        echo "La connexion à échoué.<br />";
        echo "Information : [" . $e->getCode() . "] " . $e->getMessage();
    }