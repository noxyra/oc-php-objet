<?php
// On commence par inclure les fichiers nécessaires.
require 'addendum/annotations.php';
require 'MyAnnotations.php';
require 'Personnage.php';

$reflectedClass = new ReflectionAnnotatedClass('Personnage');

echo "La valeur de l'annotation <strong>Table</strong> est <strong>" . $reflectedClass->getAnnotation("Table")->value . "</strong>";