<html>
    <head>
        <?php include('header.php'); ?>
        <title></title>
    </head>
    <body>
        <a class="btn-retour" href="list">Retour</a>
        <form class="add-bug" method="post">                       
            <?php
            if (isset($param["urlErreur"])) {
                ?>
                    <label>Titre : </label> 
                    <input type="text" name="titre" value="<?= $param["titre"]; ?>"/>
                    <label>Description : </label>
                    <textarea name="description" rows="5" cols="42"><?= $param["description"]; ?></textarea> 
                    <label>URL : </label>    
                    <input type="text" name="url" value="<?= $param["urlErreur"]; ?>"/>  
                    <label>L'url : <span class="urlErreur"><?= $param["urlErreur"]; ?></span> n'existe pas!!</label> 
                <?php
            } else {
                ?>
                     <label>Titre : </label> 
                    <input type="text" name="titre" />
                    <label>Description : </label>
                    <textarea name="description" rows="5" cols="42"></textarea> 
                    <label>URL : </label>  
                   <input type="text" name="url" value="https://"/> 
                <?php
            }
            ?>
            <input type="submit" value="OK"></p>
        </form>
    </body>
</html>

