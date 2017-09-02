<!DOCTYPE html>
<html>
<head>
    <title>TP : Mini jeu de combat</title>
    <meta charset="utf-8" />
</head>
<body>
<form action="index.php" method="post">

    <p>Nombre de personnages créés : <?= $personnageManager->count() ?></p>

    <?php
        if (isset($message)){
            echo '<p>', $message, '</p>';
        }
        if (isset($perso))
        {
            ?>
            <p><a href="?deconnexion=1">Déconnexion</a></p>

            <fieldset>
                <legend>Mes informations</legend>
                <p>
                    Nom : <?= htmlspecialchars($perso->getNom()) ?><br />
                    Dégâts : <?= $perso->getDegats() ?>
                </p>
            </fieldset>

            <fieldset>
                <legend>Qui frapper ?</legend>
                <p>
                    <?php
                    $persos = $personnageManager->getList($perso->getNom());
                    if (empty($persos))
                    {
                        echo 'Personne à frapper !';
                    }
                    else
                    {
                        foreach ($persos as $unPerso)
                            echo '<a href="?frapper=', $unPerso->getId(), '">', htmlspecialchars($unPerso->getNom()), '</a> (dégâts : ', $unPerso->getDegats(), ')<br />';
                    }
                    ?>
                </p>
            </fieldset>
            <?php
        }
        else
        {
            ?>
            <form action="" method="post">
                <p>
                    Nom : <input type="text" name="nom" maxlength="50" />
                    <input type="submit" value="Créer ce personnage" name="creer" />
                    <input type="submit" value="Utiliser ce personnage" name="utiliser" />
                </p>
            </form>
            <?php
        }
    ?>

</body>

</html>

<?php

if (isset($perso)) // Si on a créé un personnage, on le stocke dans une variable session afin d'économiser une requête SQL.

{

    $_SESSION['perso'] = $perso;

}