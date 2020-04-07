<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../src/ressources/css/styles.css">
        <script src="https://kit.fontawesome.com/1c75ff131e.js" crossorigin="anonymous"></script>
        <script src="../src/ressources/scripts/script.js"></script>
        <title></title>
    </head>
    <body> 
        <?php 
        $bug = $param["bug"]; 
        // echo "<pre>";
        // var_dump($bug);
        // echo "</pre>";
        ?>
        <a class="btn-retour" href="../list">Retour</a>
        <div class="modify-bug">
            <form method="post">
                <label>Titre : </label>
                <input type="text" name="titre" value="<?= $bug->getTitre(); ?>"/>
                <label>Description : </label>
                <textarea name="description" rows="5" cols="42"><?= $bug->getDescription(); ?></textarea>    
                <input type="submit" value="Modifier"></p>
            </form>
        </div>        
    </body>
</html>