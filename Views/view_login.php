<?php require 'view_begin.php'; ?>

<main class="connect">
    <div class="ct">
    <h1>Connexion</h1>
    <?php   echo $errorLogin;
            echo $successLogin;?>
    <form method="post" action="?controller=login&action=login">
        <div class="ct_txt">
            <input type="email" name="email" required>
            <span></span>
            <label>Adresse e-mail</label>
        </div>
        <div class="ct_txt">
            <input type="password" name="password" required>
            <span></span>
            <label>Mot de passe</label>
        </div>
        <a href="#" class="mdp_p">Mot de passe oublié ?</a>
        <input type="submit" value="Connexion" class="b_connect">
        <div class="ask">
        Nouveau ? <a href="?controller=signup">Créer un compte</a>
        </div>
    </form>
    </div>
</main>

<?php require 'view_end.php'; ?>
