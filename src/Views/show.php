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
        if(isset($bug)){
        ?>
        <a class="btn-retour" href="../list">Retour</a> 
        <div class="tab-bugs">
            <div class="thead show">                
                    <div>Titre</div>
                    <div>Description</div>
                    <div>Date de création</div>
                    <div>Status</div>
                    <div>URL</div> 
                    <div>Ip</div>              
            </div>
            <div class="trow show">
                <div><?=$bug->getTitre()?></div>
                <div><?=$bug->getDescription()?></div>
                <div><?=$bug->getCreateAt()?></div>
                <div><?=$bug->getStatus()?></div>
                <div><?=$bug->getUrl()?></div>
                <div><?=$bug->getIp()?></div>
            </div>   
        </div> 
        <?php
        } else {
            header("Location: ../404");
            exit;
        }
        ?>
    </body>
</html>


