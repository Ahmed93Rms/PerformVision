<?php
class Controller_signup extends Controller{

    public function action_signup() {
        $errorMail  = '';
        $errorMdp   = '';
        $errorCreation = '';
        $successMsg = '';

        if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_c'])) {
            $role       = htmlspecialchars($_POST['role']);
            $email      = htmlspecialchars($_POST['email']);
            $password   = htmlspecialchars($_POST['password']);
            $password_c = htmlspecialchars($_POST['password_c']);
            $nom        = htmlspecialchars($_POST['nom']);
            $prenom     = htmlspecialchars($_POST['prenom']);
            $telephone  = htmlspecialchars($_POST['telephone']);

            
            $m = Model::getModel();

            if ($m->emailExists($email)) {
                $errorMail = '<p style="color:red; text-align:center;">Le mail existe deja.</p>';
            } else if ($password != $password_c) {
                $errorMdp = '<p style="color:red; text-align:center;">Les mots de passe ne sont pas identique.</p>';
            } else {
                $m = Model::getModel();
                $userId = $m->createUser($email, $password, $nom, $prenom, $telephone);
                if ($userId) {
                    $m->assignRoleToUser($userId, $role); // Assignation du rôle
                    $successMsg = '<p style="color:green; text-align:center;">Votre compte a été créé. Connectez-vous <a href="?controller=login">ICI</a></p>';
                } else {
                    $errorCreation = '<p style="color:red; text-align:center;">Une erreur est survenue lors de la création du compte. Veuillez réessayer.</p>';
                }
            }
        }
        
                
        $data = [
            'successMsg' => $successMsg,
            'errorMail'  => $errorMail,
            'errorMdp'   => $errorMdp,
            'errorCreation' => $errorCreation
        ];
        $this->render('signup', $data);

    }



    public function action_default()
    {
        $this->action_signup();
    }
}