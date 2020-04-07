<?php
namespace BugApp\Controllers;

use BugApp\Models\BugManager;
use GuzzleHttp\Client;

class BugController{
    
    public function render($templatePath,$param){
        $templatePath = $templatePath.".php";
        ob_start();
        $param;
        require($templatePath);
        return ob_get_clean();
    }

    public function send($content,$code = 200){
        http_response_code($code);
        header("Content-type: text/html");
        echo $content;
    }

    public function add(){
        if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['url'])){
            $urlOk = $this->ControleUrl($_POST['url']);

            if ($urlOk["status"] == "success") {
                $today = new \DateTime();
                $today = $today->format('Y-m-d H:i:s');
                $bugManager = new BugManager("");
                $bugManager->addBdd(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['description']),$today, htmlspecialchars($_POST['url']), $urlOk["ip"]);    
                header("Location: list");
                exit;   
            }    
            else {
                $content = $this->render("src/Views/add", 
                [
                    "urlErreur" => htmlspecialchars($_POST['url']),
                    "titre" => htmlspecialchars($_POST['titre']),
                    "description" => htmlspecialchars($_POST['description']),
                ]);
                return $this->send($content, 200);
            }          
        } else {
            $content = $this->render("src/Views/add", "");
            return $this->send($content, 200);
        }     
    }
    
    public function list(){      
        $header = apache_request_headers();
        $bugs = [];
        $bugManager = new BugManager($bugs);
        $listBugs = [];
        if (isset($header['XMLHttpRequest'])) {
            if ($header['XMLHttpRequest']) {
                if (isset($_POST['filtre'])) {
                    if ($_POST['filtre'] == 0) {
                        $bugs = $bugManager->FindByStatus(0);
                    } else if ($_POST['filtre'] == 1){
                        $bugs = $bugManager->findAll();
                    }           
                }    
                foreach ($bugs as $bug) {
                    array_push(
                        $listBugs,
                        [
                            'id' => $bug->getId(),
                            'description' => $bug->getDescription(),
                            'titre' => $bug->getTitre(),
                            'createAt' => $bug->getCreateAt(),
                            'status' => $bug->getStatus()
                        ]
                    );                  
                }
                header('Content-type: application/json');
                $response = [
                    'success' => true,
                    'bugs' => $listBugs,
                ];
                // var_dump($listBugs);
                echo json_encode($response);
            }            
        } else {
            $bugs = $bugManager->findAll();        
            $content = $this->render("src/Views/list", ["bugs" => $bugs]);
            return $this->send($content, 200);    
        }     
    }
    
    public function show($id){  
        $bugs = [];
        $bugManager = new BugManager($bugs);
        $bug = $bugManager->find($id);  
        $content = $this->render("src/Views/show", ["bug" => $bug]);
        return $this->send($content, 200);
    }

    public function updateBug($id){       
        if(isset($_POST["typeUpdate"])){
            $bugs = [];
            $bugManager = new BugManager($bugs);
            $bug = $bugManager->find($id);            
            switch ($_POST["typeUpdate"]) {                
                case "no_resolve":
                    if(isset($_POST["status"])){
                        $bug->setStatus($_POST["status"]);
                    }  
                    $bugManager->updateBug($bug); 
                    http_response_code(200);
                    header("Content-type: application/json");
                    $response = [
                        'success' => true,
                        'id' => $bug->getId(),
                    ];
                    echo json_encode($response);
                    break;
                default:
                    http_response_code(404);
                    break;
            }
        }  
    }

    public function edit($id){
        $bugs = [];
        $bugManager = new BugManager($bugs);
        $bug = $bugManager->find($id);   
        if(!empty($_POST['titre']) || !empty($_POST['description'])){
            if(isset($_POST["titre"])){
                $bug->setTitre(htmlspecialchars($_POST["titre"]));
            }  
            if(isset($_POST["description"])){
                $bug->setDescription(htmlspecialchars($_POST["description"]));
            } 
            $bugManager->updateBug($bug); 
            http_response_code(200);  
            $_POST["demandeUpdate"] = "";
            header("Location: ../list");
        } else {
            $content = $this->render("src/Views/modify", ["bug" => $bug]);                        
            return $this->send($content, 200);
        }   
    }

    /**
     * Contrôle si le nom de domaine existe
     */
    public function recupIpByNomDomaine($nomDomaine)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'http://ip-api.com/json/'.$nomDomaine);
        
        $body = json_decode($response->getBody());

        if ($body->status == "success") {
            $rep = [
                'status' => $body->status,
                'ip' => $body->query,
            ];
        } else {
            $rep = [
                'status' => $body->status
            ];
        }
       
        return $rep;
    }

    /**
     * Contrôle la conformité de l'url à l'aide d'un regex
     */
    public function ControleUrl($url)
    {        
        if (preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?\/?/i', $url)) {
            $paramUrl = parse_url($url);                       
            $urlOk = $this->recupIpByNomDomaine($paramUrl["host"]);               
        } else {
            $urlOk = [
                'status' => "fail"
            ];
        }

        return $urlOk;
    }
}

