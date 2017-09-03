<?php

    include("autoload.php");

    $classMagicien = new ReflectionClass("Magicien");

    //========

    $mage = new Magicien(["nom" => "vyk12", "type" => "magicien"]);
    $classeMagicien = new ReflectionObject($mage);

    // Recherche d'un attribut
    if($classeMagicien->hasProperty('magie'))
    {
        echo 'Le magicien possède l\'attribut $magie';
    }
    else
        {
        echo 'Le magicien possède pas d\'attribut $magie';
    }

    // Recherche d'une méthode
    if($classeMagicien->hasMethod('lancerUnSort'))
    {
        echo "Le magicien possède la méthode lancerUnSort()";
    }
    else
    {
        echo "Le magicien ne possède pas cette méthode.";
    }

    // ... Pareil pour les constantes avec ->hasConstant().
    // => Nous pouvons récupérer sa valeur en changeant hasXXX() par getXXX()
    // => Nous pouvons récupérer la liste en ajoutant un "s" (explications batardes, mais j'me comprends :p)

    // ====================================

    // On réinstancie pour le fun.
    $classMagicien = new ReflectionClass("Magicien");

    if($parent = $classMagicien->getParentClass())
    {
        echo "Le parent de magicien est : " . $parent->getName();
    }
    else
    {
        echo "La classe magicien n'a pas de parent";
    }

    // Pareil dans l'autre sens.

    if($classMagicien->isSubclassOf("Personnage"))
    {
        echo "La classe magicien a pour parent la classe Personnage";
    }
    else
    {
        echo "Personnage n'est pas la classe parente de magicien";
    }

    // Savoir si une classe est finale ou abstraite
    $classPersonnage = new ReflectionClass("Personnage");

    if($classPersonnage->isAbstract()){
        // Est abstraite
    }
    else{
        // N'est pas abstraite
    }

    if($classPersonnage->isFinal()){
        // Est finale
    }
    else{
        // Est pas finale
    }

    // Savoir si une classe est instantiable
    if($classPersonnage->isInstantiable())
    {
        // Est instantiable
    }
    else{
        // N'est pas instantiable
    }

    // Connaitre la protection des attributs
    $uneClasse = new ReflectionClass('MaClasse');

    foreach ($uneClasse->getProperties() as $attribut)
    {
        echo $attribut->getName(), ' => attribut ';

        if ($attribut->isPublic())
        {
            echo 'public';
        }
        elseif ($attribut->isProtected())
        {
            echo 'protégé';
        }
        else
        {
            echo 'privé';
        }
    }

    // On peut aussi savoir si un attribut est statique grace à la fonction ->isStatic()

