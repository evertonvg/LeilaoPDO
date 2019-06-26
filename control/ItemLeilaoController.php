<?php

include_once "../model/ItemLeilao.php";
include_once "../pdo/ItemLeilaoPDO.php";

class itemLeilaoController{
    private $itemLeilaoPDO;
    
    public function __construct() {
        $this->itemLeilaoPDO = new itemLeilaoPDO();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Item ---------";
            echo "\n1. Inserir item";
            echo "\n2. Alterar item";
            echo "\n3. Excluir item (soft delete)";
            echo "\n4. Listar todos os itens";
            echo "\n5. Listar itens pelo nome";
            echo "\n6. Listar itens pelo código";
            echo "\n7. Reativar item pelo código";
            echo "\n8. Listar todos os itens ativos";

            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirItem();
                    break;
                case 2:
                    $this->alterarItem();
                    break;
                case 3:
                    $this->excluirItem();
                    break;
                case 4:
                    $this->listarTodosItens();
                    break;
                case 5:
                    $this->listarItensPeloNome();
                    break;
                case 6:
                    $this->listarItensPeloCodigo();
                    break;
                case 7:
                    $this->reativarItemPeloCodigo();
                    break;
                case 8:
                    $this->listarTodosItensAtivos();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    //insert (case 1)
    private function inserirItem(){
        $item = new Item_Leilao();
        echo"\nNome do Item: ";
        $item->setTitulo_item(rtrim(fgets(STDIN)));
        echo"\nDescrição do Item: ";
        $item->setDescricao(rtrim(fgets(STDIN)));
        echo"\nValor minimo do Item: ";
        $item->setLance_minimo(rtrim(fgets(STDIN)));
        echo"\nCaminho da foto do Item: ";
        $item->setCaminho_foto(rtrim(fgets(STDIN)));
        
        $item->setArrematado(false);
        
        $item->setSituacao(true); //nasce como registro válido no bd
       
        if($this->itemLeilaoPDO->insert($item)){
            echo "\Item salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
    }
    
    //update (case 2)
    private function alterarItem(){
        echo "\nDigite o código do item que você deseja alterar: ";
        $item = $this->itemLeilaoPDO->findById(rtrim(fgets(STDIN)));
        if($item != null){
            print_r($item);
            echo "\nDigite o nome do item: ";
            $titulo = fgets(STDIN);
            if($titulo != "\n"){
                $item->setTitulo_item(rtrim($titulo));
            }
            
            echo"\nDescrição do item: ";
            $descricao = fgets(STDIN);
            if($descricao != "\n"){
                $item->setDescricao(rtrim($descricao));
            }
           
            echo"\nLance minimo: ";
            $minimo = fgets(STDIN);
            if($minimo != "\n"){
                $item->setLance_minimo(rtrim($minimo));
            }
             echo"\nFoto: ";
            $foto = fgets(STDIN);
            if($foto != "\n"){
                $item->setCaminho_foto(rtrim($foto));
            }
            
             echo"\nArrematado?: ";
            $arremate = fgets(STDIN);
            if($arremate != "\n"){
                $item->setArrematado(rtrim($arremate));
            }
            
            $item->setSituacao(true);
           
            
            if($this->itemLeilaoPDO->update($item)){
                echo "\nItem alterado.";
            }else{
                echo "\nErro ao alterar o item. Contate o administrador do sistema.";
            }
        }else{
            echo "\nNão há itens cadastrados com esse código.";
        }
    }
    
    //update (case 3)
    private function excluirItem(){
        echo "\nDigite o código do item que você deseja tornar inativo: ";
        $item = $this->itemLeilaoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->itemLeilaoPDO->deleteSoft($item->getId())){
                echo "\nProduto excluído.";
            }else{
                echo "\nFalha ao reativar o produto. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }
    }

    //findAll ou SELECT sem filtros (case 4)
    private function listarTodosItens(){
        print_r($this->itemLeilaoPDO->findAll());
    }
    
    //find for name ou SELECT com filtros (case 5)
    private function listarItensPeloNome(){
        echo "\nDigite o nome para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->itemLeilaoPDO->findByNome($nome));
    }
    
    //find for id ou SELECT com filtros (case 6)
    private function listarItensPeloCodigo(){
        echo "\nDigite o código para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->itemLeilaoPDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarItemPeloCodigo(){
        echo "\nDigite o código do produto que você deseja reativar: ";
        $produto = $this->itemLeilaoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->itemLeilaoPDO->reativarProdutoPeloId($produto->getId())){
                echo "\nProduto reativado.";
            }else{
                echo "\nFalha ao reativar o produto. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }   
    }
    
    //update (case 8)
     private function listarTodosItensAtivos(){
         print_r($this->itemLeilaoPDO->findAllWithoutDeleted());
    }    
    
}
   
    



