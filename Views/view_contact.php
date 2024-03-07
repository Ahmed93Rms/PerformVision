<?php require 'view_begin.php'; ?>
<main class="connect">
    <div class="ct">
        <h1>Contactez Notre formateur</h1>
        <?php echo $envoyer;
        echo $error; ?>
        <form action="index.php?controller=contact" method="post">
            <div class="ct_txt">
                <input type="text" name="message" placeholder="Tapez votre message ici..." required></input>
            </div>
            <input type="submit" value="Envoyer le message" class="b_connect">
        </form>
        <a href="?controller=client" class="mdp_p">Retournez à votre espace.</a>
    </div>
</main>
<?php require 'view_end.php'; ?>





