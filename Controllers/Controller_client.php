<?php

class Controller_client extends Controller{

    public function action_client() {
        $welcome = $_SESSION['prenom'];
        $reussi  = "";
        $echoue  = "";

        $m             = Model::getModel();
        $categories    = $m->getCategories();
        $formateurs    = $m->getFormateurs();
        
        if (!empty($_POST["societe"])) {
            $societe       = htmlspecialchars($_POST['societe']);
            $m             = Model::getModel();
            $userId        = $_SESSION['id'];
            $updateSuccess = $m->addCompany($societe, $userId);

            if ($updateSuccess) {
                $reussi = "<p>Information ajouter avec succées.</p>";
            } else {
                $echoue = "<p>Une erreur est survenue.</p>";
            }
        }

        if (!empty($_POST['themeName'])) {
            $id_theme = ($_POST['themeName']);
            $formateursParThème = $m->getFormateursByCategorie($id_theme);
        } else {
            $formateursParThème = [];
        }
    
        $data = ['welcome' => $welcome, 'reussi'=> $reussi, 'echoue'=> $echoue, 'categories' => $categories,
        'formateurs' => $formateurs, 'formateursParThème' => $formateursParThème];
        $this->render('client', $data);
    }

    public function action_default()
    {
        $this->action_client();
    }
}
