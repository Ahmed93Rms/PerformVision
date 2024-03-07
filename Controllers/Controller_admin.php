<?php

class Controller_admin extends Controller{

    public function action_admin() {
        $welcome = $_SESSION['prenom'];
        $reussi  = "";
        $echoue  = "";

        $m          = Model::getModel();
        $categories = $m->getCategories();
        $formateurs = $m->getFormateurs();
    
        if (!empty($_POST['activite']) && !empty($_FILES['image']) && !empty($_POST['texte']) && !empty($_POST['categorieName'])) {
            $name = htmlspecialchars($_POST['activite']);
            $text = htmlspecialchars($_POST['texte']);   

            $image     = $_FILES['image'];
            $imagePath = 'uploads/' . basename($image['name']);
            move_uploaded_file($image['tmp_name'], $imagePath);

            $userId = $_SESSION['id'];

            $selectedCategorie = $_POST['categorieName'];
            $ajouAct = $m->insertActivity($name, basename($image['name']),  $text, $userId, $selectedCategorie);            

            if ($ajouAct){
                $reussi = "<p>Information ajoutée avec succès.</p>";
            } else {
                $echoue = "<p>Information ajoutée avec succès.</p>";
            }

        }
        
        $data = [
            'welcome'    => $welcome,
            'reussi'     => $reussi,
            'echoue'     => $echoue,
            'categories' => $categories,
            'formateurs' => $formateurs
        ];

        $this->render('admin', $data);
    }

    public function action_default()
    {
        $this->action_admin();
    }

    public function action_promouvoirFormateur() {

        $idUtilisateur = $_POST['idUtilisateur'];
        $m     = Model::getModel();
        if (!$m->isModerateur($idUtilisateur)) {
            $m->promouvoirFormateurEnModerateur($idUtilisateur);
            // Redirection après la promotion réussie
            header('Location: ?controller=admin&action=admin&promotionReussie=1');
        }
        else {
            // Redirection si l'utilisateur est déjà modérateur
            header('Location: ?controller=admin&action=admin&erreurPromotion=1');
        }
    }
}
