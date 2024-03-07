<?php require 'view_begin.php'; ?>

<main>
    <section class="home" id="acceuil">
        <div class="home_txt">
            <h1>RECHERCHEZ LE FORMATEUR QUI VOUS CONVIENT</h1>
            <h2>Découvrez la programmation avec nos formateurs et développez vos compétences informatiques !</h2>
            <a href="?controller=signup"><span></span>REJOIGNEZ NOUS !!!
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <img src="Content/image/modele1.png" alt="Ordinateur" class="home_img">
    </section>
    <section class="nf" id="formateurs">
        <h1>NOS COLLABORATEURS</h1>
        <div class="nf_bloc">
            <article class="nf_case">
                <div><img src="Content/image/formateur1.jpg" class="nf_img" alt="formateur1"></div>
                <h3 class="nf_txt">DEVELOPPEUR JAVA</h3>
            </article>
            <article class="nf_case">
                <div><img src="Content/image/formateur1.jpg" class="nf_img" alt="formateur1"></div>
                <h3 class="nf_txt">DEVELOPPEUR PHP</h3>
            </article>
            <article class="nf_case">
                <div><img src="Content/image/formateur1.jpg" class="nf_img" alt="formateur1"></div>
                <h3 class="nf_txt">DEVELOPPEUR JS</h3>
            </article>
        </div>
    </section>
    <section class="lp">
        <h1>LES LANGUAGES QUE NOTRE EQUIPE DE FORMATEURS PROPOSENT</h1>
        <div class="Line1">           
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/python_logo.png" class="lp_img" alt="imgPython"></a>
                <h3>PYTHON</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/java_logo.png" class="lp_img" alt="imgJAVA"></a>
                <h3>JAVA</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/C_logo.png" class="lp_img" alt="imgC++"></a>
                <h3>C++</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/sql_logo.png" class="lp_img" alt="imgSQL"></a>
                <h3>SQL</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/html_logo.png" class="lp_img" alt="imgHTML"></a>
                <h3>HTML</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/css_logo.png" class="lp_img" alt="imgCSS"></a>
                <h3>CSS</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/js_logo.png" class="lp_img" alt="imgJS"></a>
                <h3>JS</h3>
            </article>
            <article class="lp_case">
                <a href="?controller=signup"><img src="Content/image/php_logo.png" class="lp_img" alt="imgPHP"></a>
                <h3>PHP</h3>
            </article>
        </div>
        <h3>Et bien plus encore ...</h3>
    </section>
    <section class="act_all">
    <h1 style="text-align: center; color: white; font-size: 42px;">Activités</h1>
    <div class="form_all">
        <?php foreach($activites as $activite): ?>
        <div class="formateur">    
            <p>Nom de l'activité : <?php echo $activite['nom_activite']; ?></p>
            <img src='uploads/<?php echo $activite['image']; ?>' class="act_img" alt="img_act"/>
            <p>Description: <?php echo $activite['texte']; ?></p>
            <p>Categorie: <?php echo $activite['nom_categorie']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    </section>
    <section class="pr_all" id="apropos">
        <h1>Qui sommes nous ?</h1>
        <div class="pr">
            <img src="Content/image/classe.png" alt="salle_classe" class="pr_img" />
            <div class="pr_txt" >
                SAS Perform Vision est une entreprise informatique offrant une plateforme d'apprentissage de qualité dans divers langages de programmation tels que Python, Java et C.
                </br></br>Axés sur la simplicité et la compréhension, nos formateurs qualifiés vous accompagnent à chaque étape de votre parcours, adaptant les cours à tous les niveaux, que vous soyez débutant ou professionnel.
                </br></br>Rejoignez SAS Perform Vision aujourd'hui et commencez votre voyage vers l'apprentissage des langages de programmation !
            </div>
        </div>
    </section>
    <section class="cont" id="contact" >
        <article class="coordo">
            <h2>Contactez-nous</h2>
            <p>
                Des questions, une idéé, une ambition ? Parlons-en ! 
                Notre équipe est disponible pour vous accompagner.
            </p>
            <div class="coordo_info">
                <span class="material-symbols-outlined cont_logo" style="font-size: 52px;">mail</span>
                <div>
                    <a href="mailto:saspvcontact@gmail.com" style="color: white; text-decoration: none;"><strong>Mail : </strong>saspvcontact@gmail.com</a>
                </div>
            </div>
            <div class="coordo_info">
                <span class="material-symbols-outlined cont_logo" style="font-size: 52px;">call</span>
                <div>
                    <p><strong>Télephone : </strong>+33 1 25 25 52 52</p>
                </div>
            </div>
        </article>
        <!--<article class="cont_form">
            <h2>Ecrivez-nous</h2>
            <p>
                En envoyant ce formulaire, j'accepte que mes données soient utilisées pour traiter ma demande,
                en accord avec le RGPD (Règlement Général sur la Protection des Données).
            </p>
            <form method="post" action="?controller=home&action=home">
                <div class="cont_txt">
                    <input type="text" name="nom">
                    <span></span>
                    <label>Nom</label>
                </div>
                <div class="cont_txt">
                    <input type="mail" name="mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+">
                    <span></span>
                    <label>Adresse e-mail</label>
                </div>
                <div class="cont_txt">
                    <textarea id="message" name="message" rows="15" cols="47" placeholder="      Message" style="border-radius: 15px;"></textarea>
                </div>
                <button class="b_cont" type="submit">Envoyer</button>
            </form>
        </article>-->
    </section>
</main>

<?php require 'view_end.php'; ?>
