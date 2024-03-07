<?php

class Controller_home extends Controller{

    public function action_home()
    {
        $m          = Model::getModel();
        $categories = $m->getCategories();
        $activites  = $m->getActivity();

        /*if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nom'], $_POST['mail'], $_POST['message'])) {
            $nom     = $_POST['nom'];
            $mail    = $_POST['mail'];
            $message = $_POST['message'];
        
            $to      = 'saspvcontact@gmail.com';
            $subject = 'Nouveau message de ' . $nom;
            $headers = 'From: ' . $mail;
        
            mail($to, $subject, $message, $headers);
        }*/

        $data = [
            'categories' => $categories,
            'activites'  => $activites
        ];

        $this->render('home', $data);
    }

    public function action_default()
    {
        $this->action_home();
    }
}
