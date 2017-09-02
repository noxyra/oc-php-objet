<?php
function chargerClasse($classname)
{
    require '../Entitees/' . $classname.'.php';
}
spl_autoload_register('chargerClasse');