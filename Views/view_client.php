<?php require "view_beginco.php"; ?>

<main>
    <h1 style="color: white; text-align: center;">Bonjour<?php if (!empty($welcome)) : ?> <?php echo $welcome ?><?php endif; ?></h1>
    <div class="document">
        <form action="?controller=client&action=client" method="post">
            <div class="input_f">Indiquez le nom de votre société : <input type="text" name="societe" required></div>
            <button type="submit" class="b_form">Ajouter</button>
        </form>
        <?php echo $reussi;
              echo $echoue; ?>
    </div>
    <div class="document">Rechercher un formateur par catégorie : 
        <form action="?controller=client&action=client" method="post">
            <select id="categorieSelect" name="categorie">
                    <?php foreach ($categories as $categorie): ?>
                    <option value="<?php echo $categorie['id_categorie']; ?>"><?php echo $categorie['nom_categorie']; ?></option>
                    <?php endforeach; ?>
                </select> 
                <select id="themeSelect" name="themeName">
                </select>  
            <button type="submit" class="b_form">Rechercher</button>
        </form>  
    </div>

    <!-- Section pour afficher les résultats de la recherche -->
    <div class="act_all">
        <h2 style="text-align: center; color: white; font-size: 32px;">Résultats de la recherche</h2>
        <div class="form_all">
            <?php foreach ($formateursParThème as $formateurs): ?>
                <div class="formateur">    
                    <p>Formateur : <?php echo $formateurs['nom']; ?> <?php echo $formateurs['prenom']; ?></p>
                    <a href="<?php echo $formateurs['linkedin']; ?>">LinkedIn du formateur</a>
                    <a href="?controller=contact" type="submit" class="b_forma">Contacter</a>      
                </div>   
            <?php endforeach; ?>
        </div>
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
</script>

<?php require "view_end.php"; ?>
