<?php
    interface iInterface
    {
        const CONSTANT = "Hello !";
    }

    echo iInterface::CONSTANT; // Affiche Hello !

    class LaClasse implements iInterface
    {
        // On ne peut pas écraser la constante de classe ici.
    }

    echo iInterface::CONSTANT; // Affichera toujours Hello !