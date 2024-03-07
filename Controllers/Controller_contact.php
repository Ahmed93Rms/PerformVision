
<?php

class Controller_contact extends Controller
{
    public function action_contact(){
        $envoyer = '';
        $error   = '';
        $m = Model::getModel();
        if (!empty($_POST['message'])) {
            $texte  = htmlspecialchars($_POST['message']);
            $date   = date("Y-m-d H:i:s");
            $userId = $_SESSION['id']; 
            $reussi = $m->saveMessage($texte, $date, $userId);

            if ($reussi) {
                $envoyer = '<div style="color:green; text-align:center;">Le message a bien été envoyé.</div>';
            } else {
                $error   = '<div style="color:green; text-align:center;">Le message a bien été envoyé.</div>';
            }

        }
        $data = ['envoyer' => $envoyer, 'error' => $error];
        $this->render("contact", $data);
    }

    public function action_default()
    {
        $this->action_contact();
    }

}