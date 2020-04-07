<?php
namespace BugApp\Models;
/**
 * Contenus d'un bug
 */
class Bug {
    private $id;
    private $description;
    private $titre;
    private $createAt;
    private $status;
    private $url;
    private $ip;
    
    function __construct($id, $titre,$description,$createAt,$status, $url, $ip) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->createAt = $createAt;
        $this->status = $status;
        $this->url = $url;
        $this->ip = $ip;
    }  

    function getId():int {
        return $this->id;
    } 

    function setId($id) {
        $this->id = $id;
    }

    function getTitre() {
        return $this->titre;
    }

    function setTitre($titre) {
        $this->titre = $titre;
    }
    
    function getDescription():string {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }   
   
    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getCreateAt() {
        return $this->createAt;
    }

    function setCreateAt($createAt) {
        $this->createAt = $createAt;
    }

    function getUrl() {
        return $this->url;
    }

    function setUrl($url) {
        $this->nomDomaine = $url;
    }

    function getIp() {
        return $this->ip;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }
}
