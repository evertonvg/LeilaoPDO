<?php

include_once "ParticipanteController.php";

include_once "LanceController.php";

include_once "ItemLeilaoController.php";

include_once "LeilaoController.php";

class MainController {
    
    private $participanteController;
    private $lanceController;
    private $itemController;
    private $leilaoController;
    
    public function __construct() {
        //cria todos os controllers
        $this->participanteController = new participanteController();
        //$this->lanceController = new lanceController();
        //$this->itemController = new itemController();
        //$this->leilaoController = new leilaoController();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Menu ---------";
            
            echo "\n1. Manter Participante";
            echo "\n2. Manter Lances";
            echo "\n3. Manter Itens";
            echo "\n4. Manter Leilão";

            echo "\n0. Sair ";
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                       $this->participanteController->exibeMenu();        
                    break;
                case 2:
                        $this->lanceController->exibeMenu();
                    break;
                case 3:
                    echo "\nEm desenvolvimento.";
                    break;
                case 4:
                    echo "\nEm desenvolvimento.";
                    break;
                
                default:
                    echo "\nOpção inexistente.";
            }
        }
    }
        
}//fim class

//inicializa a app
$mainController = new MainController();
$mainController->exibeMenu();
