<?php require "view_beginco.php"; ?>

<main>
    <h1 style="color: white; text-align: center;">Bonjour<?php if (!empty($welcome)) : ?> <?php echo $welcome ?><?php endif; ?></h1>
    <div class="document">
        <h1>Ajouter vos infos</h1>
        <form action="?controller=formateur&action=formateur" method="post" enctype="multipart/form-data">
            <div class="input_f">LinkedIn* : <input type="url" name="LinkedIn" required></div>
            <div class="input_f">Renseigner son taux horaire* : <input type="number" name="taux" required></div>
            <div class="input_f">CV : <input type="file" name="image"></div>
            <button type="submit" class="b_form">Envoyer</button>
        </form>
        <?php echo $reussi;
              echo $echoue; ?>
    </div>

    <div class="compet">
        <h1>Ajouter une compétences pédagogique</h1>
        <form action="?controller=formateur&action=formateur" method="post">
            <div class="input_f">Catégorie :  
                <select id="categorieSelect" name="categorie">
                    <?php foreach ($categories as $categorie): ?>
                    <option value="<?php echo $categorie['id_categorie']; ?>"><?php echo $categorie['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select> 
                <select id="themeSelect" name="theme">
                </select>
            </div>
            <div class="input_f">Nombre d'heures moyen par session : <input type="number" name="heures" required></div>
            <div class="input_f">Nombre de session effectué : <input type="number" name="session" required></div>
            <div class="input_f">Commentaire(facultatif) : <input type="text" name="com"></div>
            <button type="submit" class="b_form">Ajouter</button>
        </form>
        <?php echo $add;
              echo $notAdd; ?>
    </div>

    <div class="compet">
        <h1>Ajouter une expériences professionelle</h1>
        <form action="?controller=formateur&action=formateur" method="post">
            <div class="input_f">Catégorie :  
                <select id="categorieSelect2" name="categorie">
                    <?php foreach ($categories as $categorie): ?>
                    <option value="<?php echo $categorie['id_categorie']; ?>"><?php echo $categorie['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select> 
                <select id="themeSelect2" name="theme">
                </select>
            </div>
            <div class="input_f">Durée moyenne par experience(en mois) : <input type="number" name="exp" required></div>
            <div class="input_f">Commentaire(facultatif) : <input type="text" name="com"></div>
            <div class="input_f">Niveau :
                <select id="niveauSelect" name="niveau">
                    <?php foreach ($niveaux as $niveau): ?>
                    <option value="<?php echo $niveau['id_niveau']; ?>"><?php echo $niveau['libelle_niveau']; ?></option>
                    <?php endforeach; ?>
                </select> 
            </div>
            <button type="submit" class="b_form">Ajouter</button>
        </form>
        <?php echo $add;
              echo $notAdd; ?>
    </div>

    <div class="compet">
        <h1>Ajouter un thème inexistant</h1>
        <form action="?controller=formateur&action=formateur" method="post">
            <div class="input_f">Catégorie :  
                <select id="categorieSelect" name="categorie" required>
                    <?php foreach ($categories as $categorie): ?>
                    <option value="<?php echo $categorie['id_categorie']; ?>"><?php echo $categorie['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select> 
            </div>
            <div class="input_f">Ajouter un thème : <input type="text" name="newTheme" required></div>
            <button type="submit" class="b_form">Ajouter</button>
        </form>
        <?php echo $add;
              echo $notAdd; ?>
    </div>

</main>

<script>
    function updateThemeSelect(categorieSelectId, themeSelectId) {
        document.getElementById(categorieSelectId).addEventListener('change', function() {
            var categorieId = this.value;
            fetch('?controller=formateur&action=getThemesByCategorie&id=' + categorieId)
                .then(response => response.json())
                .then(themes => {
                    var themeSelect = document.getElementById(themeSelectId);
                    themeSelect.innerHTML = '';
                    themes.forEach(function(theme) {
                        var option = document.createElement('option');
                        option.value = theme.id_theme;
                        option.textContent = theme.nom_theme;
                        themeSelect.appendChild(option);
                    });
                });
        });
    }

    // Appliquer la fonction aux différents formulaires
    updateThemeSelect('categorieSelect', 'themeSelect'); // Pour le deuxième formulaire
    updateThemeSelect('categorieSelect2', 'themeSelect2'); // Pour le troisième formulaire
    // Ajoutez d'autres lignes similaires pour les formulaires supplémentaires si nécessaire
</script>

<?php require "view_end.php"; ?>
