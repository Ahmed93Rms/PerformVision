<?php require "view_beginco.php"; ?>
<main>
    <h1 style="color: white; text-align: center;">Bonjour<?php if (!empty($welcome)) : ?> <?php echo $welcome ?><?php endif; ?></h1>
    <div class="document">
        <h1>Ajouter des activités</h1>
        <form action="?controller=admin&action=admin" method="post" enctype="multipart/form-data">
            <div class="input_f">Nom de l'activité : <input type="text" name="activite" required></div>
            <div class="input_f">Image (JPG OU PNG SEULEMENT) : <input type="file" name="image" required></div>
            <div class="input_f">Description : <input type="text" name="texte" required></div>
            <label for="carSelector">Sélectionnez une catégorie :</label>
            <select id="Selector" name="categorieName">
                <?php foreach ($categories as $categorie): ?>
                <option value="<?php echo $categorie['id_categorie']; ?>"><?php echo $categorie['nom_categorie']; ?></option>
                <?php endforeach; ?>
            </select>            
            <button type="submit" class="b_form">Ajouter</button>
        </form>
        <?php echo $reussi;
               echo $echoue; ?>
    </div>

    <?php if(isset($_GET['promotionReussie'])): ?>
        <p style="color: white; text-align: center;">Promotion réalisée avec succès.</p>
    <?php endif; ?>
    <?php if(isset($_GET['erreurPromotion'])): ?>
        <p style="color: white; text-align: center;">L'utilisateur est déjà modérateur.</p>
    <?php endif; ?>
    
    <div class="form_all">
        <?php foreach($formateurs as $formateur): ?>
        <div class="formateur">    
            <p>Prénom: <?php echo $formateur['prenom']; ?></p>
            <p>Nom: <?php echo $formateur['nom']; ?></p>
            <p>Email: <?php echo $formateur['mail']; ?></p>
            <form action="?controller=admin&action=promouvoirFormateur" method="post">
                <input type="hidden" name="idUtilisateur" value="<?php echo $formateur['id_utilisateur']; ?>">
                <button type="submit">Promouvoir</button>
            </form>

        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require "view_end.php"; ?>