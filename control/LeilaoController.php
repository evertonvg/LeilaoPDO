<?php

include_once "../model/Leilao.php";
include_once "../pdo/LeilaoPDO.php";

include_once "../model/ItemLeilao.php";
include_once "../pdo/ItemLeilaoPDO.php";

class leilaoController{
    private $leilaoPDO;
    private $itemLeilaoPDO;
     
    public function __construct() {
        $this->leilaoPDO = new leilaoPDO();
        $this->itemLeilaoPDO = new itemLeilaoPDO();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Leilão ---------";
            echo "\n1. Criar leilão (inserir leilão)";
            echo "\n2. Alterar leilão";
            echo "\n3. Excluir leilão (soft delete)";
            echo "\n4. Listar todos os itens";
            echo "\n5. Listar leilões pelo item";
            echo "\n6. Listar leilões pelo código";
            echo "\n7. Reativar leilão pelo código";
            echo "\n8. Listar todos os leilões ativos";

            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->inserirLeilao();
                    break;
                case 2:
                    $this->alterarleilao();
                    break;
                case 3:
                    $this->excluirleilao();
                    break;
                case 4:
                    $this->listarTodosleiloes();
                    break;
                case 5:
                    $this->listarLeiloesPeloNomeItem();
                    break;
                case 6:
                    $this->listarLeiloesPeloCodigo();
                    break;
                case 7:
                    $this->reativarLeilaoPeloCodigo();
                    break;
                case 8:
                    $this->listarTodosLeiloesAtivos();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    //insert (case 1)
    private function inserirLeilao(){
        $leilao = new Leilao();
        
        echo "\nSelecione o item na lista abaixo digitando seu código";
        $itens = $this->itemLeilaoPDO->findAllWithoutDeleted();
        if($itens != null){
            echo "\nLista de itens cadastrados\n";
            print_r($itens);
            echo "\nCódigo do item: ";
            $item = null;
            while($item == null){
                $id = rtrim(fgets(STDIN));
                $item = $this->itemLeilaoPDO->findById($id);
                if($item != null){
                    echo "\nItem " . $item->getNome(). " " . $item->getId() . " selecionado.";
                }else{
                    echo "\nNão foi possível selecionar este cliente. Tente novamente.";
                }
            }
            $exit = -1;
        }
            
        echo"\nData de inicio do leilão: ";
        $item->getDt_inicio(rtrim(fgets(STDIN)));
        echo"\nData final do leilão: ";
        $item->getDt_final(rtrim(fgets(STDIN)));
        echo"\nHora de inicio do leilão: ";
        $item->getHor_inicio(rtrim(fgets(STDIN)));
        echo"\nHora de encerramento do leilão: ";
        $item->getHor_final(rtrim(fgets(STDIN)));
        

       
        if($this->LeilaoPDO->insert($leilao)){
            echo "\leilão salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
    }
    
    //update (case 2)
    private function alterarleilao(){
        echo "\nDigite o código do Leilão que você deseja alterar: ";
        $leilao = $this->leilaoPDO->findById(rtrim(fgets(STDIN)));
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
    private function excluirleilao(){
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
    private function listarTodosleiloes(){
        print_r($this->itemLeilaoPDO->findAll());
    }
    
    //find for name ou SELECT com filtros (case 5)
    private function listarLeiloesPeloNomeItem(){
        echo "\nDigite o nome para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->itemLeilaoPDO->findByNome($nome));
    }
    
    //find for id ou SELECT com filtros (case 6)
    private function listarLeiloesPeloCodigo(){
        echo "\nDigite o código para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->itemLeilaoPDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarLeilaoPeloCodigo(){
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
     private function listarTodosLeiloesAtivos(){
         print_r($this->itemLeilaoPDO->findAllWithoutDeleted());
    }    
    
}
   
    



