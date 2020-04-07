<!DOCTYPE html>
<html>
    <head>
        <?php include('header.php'); ?>
        <title></title>
    </head>
    <body>  
        <div class="list-bugs">
            <h1>Liste des bugs</h1>
            <div class="menu">
                <div class="ajout-btn">
                    <label>Consigner un bug</label>
                    <a href="add"><i class="fas fa-plus-circle"></i></a>
                </div>
                <div class="filtre">
                    <label for="filtre_status">Filtrer</label>
                    <input type="checkbox" name="filtre" id="filtre" onchange="FilterByStatus(event)">
                </div>
            </div>            
        <?php        
        $bugs = $param["bugs"];
        ?>
        <div class="tab-bugs" id="tab-bugs">
            <div class="thead">
                <div>ID</div>
                <div>Titre</div>
                <div>Date de création</div>
                <div>Status</div>
                <div>Action</div>
                <div>Modifier</div>
            </div>
        <?php
            foreach ($bugs as $bug) {
                ?>
            <div class="trow">
                <div>
                    <?php
                    echo $bug->getId();
                    ?>
                </div>
                <div>
                    <?php
                    echo $bug->getTitre();
                     ?>
                </div>   
                <div>
                    <?php
                    echo $bug->getCreateAt();
                     ?>
                </div>
                <div>
                    <?php
                    if($bug->getStatus() == 0){
                        ?>
                        <a class="no_resolve" id="bug_<?= $bug->getId(); ?>" onclick="MakeRequest(event,<?= $bug->getId(); ?>)">Non Résolu</a>
                        <?php
                    } else if($bug->getStatus() == 1){
                        ?>
                        <span id="resolve" class="resolve">Résolu</span>
                        <?php
                    }
                     ?>
                </div>
                <div>
                    <a href="show/<?= $bug->getId() ?>">Détails</a>
                </div> 
                <div>
                    <a id="modify" class="modify" href="edit/<?= $bug->getId(); ?>"><i class="fas fa-file-invoice"></i></a>
                    <!-- <a id="modify" class="modify" onclick="MakeRequest(event,<?= $bug->getId(); ?>)"><i class="fas fa-file-invoice"></i></a> -->
                </div>             
            </div>
                <?php
            }
        ?>
        </div>
        </div>  
    </body>
</html>
