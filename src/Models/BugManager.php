<?php
namespace BugApp\Models;

use BugApp\Models\Bug;
use BugApp\Models\Manager;
/**
 * Classe qui va gérer la liste des bugs
 */
class BugManager extends Manager{
    private $bugs = [];  
    private $manager;
    private $bdd;
    function __construct($bugs) {
        $this->bugs = $bugs;
        $this->manager = new Manager();
        $this->bdd = $this->manager->getBdd();
    }
    
    /**
     * Charger en mémoire la liste des bugs présent dans notre base de données
     */
    function findAll(){ 
        // Récupérer données depuis la BDD        
        $reponse = $this->bdd->query('SELECT * FROM list_bugs');
        while($donnees = $reponse->fetch()) {            
            $bug = new Bug($donnees["id"],$donnees["titre"],$donnees["description"],$donnees["createAt"],$donnees["status"],$donnees["url"],$donnees["ip"]);
            $this->load($bug);
        }
        $reponse->closeCursor();
        return $this->bugs;       
    }

    /**
     * Retourne les status filtrer par status
     */
    function FindByStatus($status){
        $reponse = $this->bdd->prepare("SELECT * FROM list_bugs WHERE status = :status");
        $reponse->execute([':status' => $status]);
        while($donnees = $reponse->fetch()) {            
            $bug = new Bug($donnees["id"],$donnees["titre"],$donnees["description"],$donnees["createAt"],$donnees["status"],$donnees["url"],$donnees["ip"]);
            $this->load($bug);
        }
        $reponse->closeCursor();
        return $this->bugs;   
    }
    
    /**
     * Ajout chaque bug dans un tableau qui sera retourné dans index.php
     * pour afficher la liste complète des bugs
     * @param type $bug
     */
    function load($bug){
        array_push($this->bugs,$bug);
    }
    
    /**
     * Ajout un nouveau bug dans la base de données
     * @param type $titre
     * @param type $description
     */
    function addBdd($titre,$description,$createAt,$nomDomaine,$ip){       
        $reponse = $this->bdd->prepare("INSERT INTO list_bugs (titre, description,createAt,url,ip) VALUES (:titre, :description,:createAt,:url,:ip)");
        $reponse->bindParam(':titre', $titre);
        $reponse->bindParam(':description', $description);  
        $reponse->bindParam(':createAt', $createAt); 
        $reponse->bindParam(':url', $nomDomaine); 
        $reponse->bindParam(':ip', $ip); 
        $reponse->execute();
    }
    
    /**
     * Récupère une entrée dans la base avec son id
     * @param type $id
     * @return \Bug
     */
    function find($id){   
        $reponse = $this->bdd->prepare("SELECT * FROM list_bugs WHERE id = :id");
        $reponse->execute([':id' => $id]);
        $donnees = $reponse->fetch();         
        $bug = new Bug($donnees["id"],$donnees["titre"],$donnees["description"],$donnees["createAt"],$donnees["status"],$donnees["url"],$donnees["ip"]); 
        $reponse->closeCursor();

        if(isset($bug)){
           return $bug;  
        }                   
    }
    
    /**
     * Supprimer un bug
     * @param type $bug - Objet bug contenant toutes ses informations
     */
    function remove(Bug $bug){
        $reponse = $this->bdd->prepare("DELETE FROM list_bugs WHERE id = :id");
        $reponse->bindParam(':id', $bug->getId());
        $reponse->execute();
        $reponse->closeCursor();
    }     
    
    /**
     * Met à jour le statut du bug
     * @param type $bug - Objet bug contenant toutes ses informations
     * @param type $status
     */
    function updateBug(Bug $bug){
        $id =  $bug->getId();
        $titre = $bug->getTitre();
        $description = $bug->getDescription();
        $status = $bug->getStatus();
        $reponse = $this->bdd->prepare("UPDATE list_bugs SET titre = :titre, description = :description, status = :status WHERE id = :id");
        $reponse->bindParam(':id', $id);
        $reponse->bindParam(':titre', $titre);
        $reponse->bindParam(':description', $description);
        $reponse->bindParam(':status', $status); 
        $reponse->execute();
        $reponse->closeCursor();
    }
}
