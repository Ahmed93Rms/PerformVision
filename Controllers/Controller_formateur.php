<?php

class Controller_formateur extends Controller{

    public function action_formateur() {
        $welcome = $_SESSION['prenom'];
        $reussi  = "";
        $echoue  = "";
        $add     = "";
        $notAdd  = "";

        $m          = Model::getModel();
        $categories = $m->getCategories();
        $themes     = $m->getThemes();
        $niveaux    = $m->getNiveaux();
    
        if (!empty($_POST["LinkedIn"]) && !empty($_POST["taux"])) {
            $linkedin = htmlspecialchars($_POST['LinkedIn']);
            $taux     = htmlspecialchars($_POST['taux']);
            $m        = Model::getModel();

            $image     = $_FILES['image'];
            $imagePath = 'uploads/' . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);

            $userId   = $_SESSION['id'];
            $updateSuccess = $m->updateFormateurInfo($userId, $linkedin, $imagePath, $taux);


            if ($updateSuccess) {
                $reussi = "<p>Information ajoutée avec succès.</p>";
            } else {
                $echoue = "<p>Une erreur est survenue.</p>";
            }
        }

        if (!empty($_POST["theme"]) && !empty($_POST["heures"]) && !empty($_POST["session"])) {
            $idUser      = $_SESSION['id'];
            $idTheme     = $_POST['theme'];
            $heures      = $_POST['heures'];
            $sessions    = $_POST['session'];
            $commentaire = $_POST['com'];
    
            $m        = Model::getModel();
            $addComp  = $m->addExperience($idUser, $idTheme, $heures, $sessions, $commentaire);
        
            if ($addComp) {
                $add    = "<p>Information ajoutée avec succès.</p>";
            } else {
                $notAdd = "<p>Information ajoutée avec succès.</p>";
            }
        }

        if (!empty($_POST["theme"]) && !empty($_POST["exp"]) && !empty($_POST["niveau"])) {
            $idUser      = $_SESSION['id'];
            $idTheme     = $_POST['theme'];
            $exp         = $_POST['exp'];
            $commentaire = $_POST['com'];
            $idNiveau    = $_POST['niveau'];
    
            $m        = Model::getModel();
            $addComp  = $m->addExperiencePro($idUser, $idTheme, $exp, $commentaire, $idNiveau);
        
            if ($addComp) {
                $add    = "<p>Information ajoutée avec succès.</p>";
            } else {
                $notAdd = "<p>Information ajoutée avec succès.</p>";
            }
        }

        if (!empty($_POST["categorie"]) && !empty($_POST["newTheme"])) {
        $m        = Model::getModel();
        $addTheme = $m->addTheme($_POST['categorie'], $_POST['newTheme']);
        
        if ($addTheme) {
            $add    = "<p>Information ajoutée avec succès.</p>";
        } else {
            $notAdd = "<p>Information ajoutée avec succès.</p>";
        }
    
        }
        
    
        $data = ['welcome' => $welcome, 'reussi'=> $reussi,
        'echoue'=> $echoue, 'categories' => $categories,
        'themes' => $themes, 'add' => $add, 'notAdd' => $notAdd,
        'niveaux' => $niveaux];
        $this->render('formateur', $data);
    }

    public function action_getThemesByCategorie() {
        $categorieId = $_GET['id'];
        $m = Model::getModel();
        $themes = $m->getThemesByCategorie($categorieId);
        echo json_encode($themes);
    }

    public function action_default()
    {
        $this->action_formateur();
    }
}
