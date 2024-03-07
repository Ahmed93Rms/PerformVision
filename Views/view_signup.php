<?php require 'view_begin.php'; ?>

<main class="connect">
    <div class="ct">
    <h1>Inscription</h1>
    <?php   echo $errorMail;
            echo $errorMdp; 
            echo $errorCreation;
            echo $successMsg; ?>
    <form method="post" action="?controller=signup&action=signup">
        <p><i>Les champs marqués avec * sont obligatoires.</i></p>
        <p>Vous êtes ?</p>
        <p><input type="radio" id="client" name="role" value="client" required checked>Client</p>
        <p><input type="radio" id="formateur" name="role" value="formateur" required>Formateur</p>
        <div class="ct_txt">
            <input type="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+">
            <span></span>
            <label>Adresse e-mail*</label>
        </div>
        <div class="ct_txt">
            <input type="password" name="password" required>
            <span></span>
            <label>Mot de passe*</label>
        </div>
        <div class="ct_txt">
            <input type="password" name="password_c" required>
            <span></span>
            <label>Confirmer le mot de passe*</label>
        </div>
        <div id="name" class="ct_txt">
            <input type="name" name="nom" required>
            <span></span>
            <label>Nom*</label>
        </div>
        <div id="prenom" class="ct_txt">
            <input type="text" name="prenom" required>
            <span></span>
            <label>Prénom*</label>
        </div>
        <div id="telephone" class="ct_txt">
            <input type="telephone" name="telephone">
            <span></span>
            <label>Télephone</label>
        </div>
        <input type="submit" value="S'inscrire" class="b_connect">

        <div class="ask">
            Déjà un compte ? <a href="?controller=login">Se connecter</a>
        </div>

        </form>
    </div>
</main>

<?php require 'view_end.php'; ?>
