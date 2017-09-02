<?php
    include("autoload.php"); // Autoload

    session_start();

    if(isset($_GET['deconnexion'])){
        session_destroy();
        header('Location: .');
        exit();
    }

    if(isset($_SESSION['perso'])){
        $perso = $_SESSION['perso'];
    }

    include ("database.php"); // Database

    $personnageManager = new PersonnageManager($db); // Chargement du manager de personnages

    if (isset($_POST['creer']) && isset($_POST['nom'])) // Si on a voulu créer un personnage.
    {
        $perso = new Personnage(['nom' => $_POST['nom']]); // On crée un nouveau personnage.

        if (!$perso->nomValide())
        {
            $message = 'Le nom choisi est invalide.';
            unset($perso);
        }
        elseif ($personnageManager->exists($perso->getNom()))
        {
            $message = 'Le nom du personnage est déjà pris.';
            unset($perso);
        }
        else
        {
            $personnageManager->add($perso);
        }
    }
    elseif (isset($_POST['utiliser']) && isset($_POST['nom'])) // Si on a voulu utiliser un personnage.
    {
        if ($personnageManager->exists($_POST['nom'])) // Si celui-ci existe.
        {
            $perso = $personnageManager->get($_POST['nom']);
        }
        else
        {
            $message = 'Ce personnage n\'existe pas !'; // S'il n'existe pas, on affichera ce message.
        }
    }
    elseif (isset($_GET['frapper'])) // Si on a cliqué sur un personnage pour le frapper.
    {
        if (!isset($perso))
        {
            $message = 'Merci de créer un personnage ou de vous identifier.';
        }
        else
        {
            if (!$personnageManager->exists((int) $_GET['frapper']))
            {
                $message = 'Le personnage que vous voulez frapper n\'existe pas !';
            }
            else
            {
                $persoAFrapper = $personnageManager->get((int) $_GET['frapper']);
                $retour = $perso->frapper($persoAFrapper); // On stocke dans $retour les éventuelles erreurs ou messages que renvoie la méthode frapper.

                switch ($retour)
                {
                    case Personnage::CEST_MOI :
                        $message = 'Mais... pourquoi voulez-vous vous frapper ???';
                        break;
                    
                    case Personnage::PERSONNAGE_FRAPPE :
                        $message = 'Le personnage a bien été frappé !';
                        $personnageManager->update($perso);
                        $personnageManager->update($persoAFrapper);
                        break;
                    
                    case Personnage::PERSONNAGE_TUE :
                        $message = 'Vous avez tué ce personnage !';
                        $personnageManager->update($perso);
                        $personnageManager->delete($persoAFrapper);
                        break;
                }
            }
        }
    }

    include ("view.php");