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
            echo "\n\n--------- Submenu Produto ---------";
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
       
        if($this->itemLeilaoPDO->insert($produto)){
            echo "\Item salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
    }
    
    //update (case 2)
    private function alterarItem(){
        echo "\nDigite o código do produto que você deseja alterar: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        if($produto != null){
            print_r($produto);
            echo "\nDigite o nome do produto: ";
            $nome = fgets(STDIN);
            if($nome != "\n"){
                $produto->setNome(rtrim($nome));
            }
            echo"\nDescrição do Produto: ";
            $descricao = fgets(STDIN);
            if($descricao != "\n"){
                $produto->setDescricao(rtrim($descricao));
            }
            echo"\nValor do Produto (sistema americano): ";
            $valor = fgets(STDIN);
            if($valor != "\n"){
                $produto->setValor(rtrim($valor));
            }
            echo"\nQuantidade em estoque: ";
            $quantidade = fgets(STDIN);
            if($quantidade != "\n"){
                $produto->setQuantidade(rtrim($quantidade));
            }
            if($this->produtoPDO->update($produto)){
                echo "\nProduto alterado.";
            }else{
                echo "\nErro ao alterar o produto. Contate o administrador do sistema.";
            }
        }else{
            echo "\nNão há produtos cadastrados com esse código.";
        }
    }
    
    //update (case 3)
    private function excluirItem(){
        echo "\nDigite o código do produto que você deseja tornar inativo: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->produtoPDO->deleteSoft($produto->getId())){
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
        print_r($this->produtoPDO->findAll());
    }
    
    //find for name ou SELECT com filtros (case 5)
    private function listarItensPeloNome(){
        echo "\nDigite o nome para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->produtoPDO->findByNome($nome));
    }
    
    //find for id ou SELECT com filtros (case 6)
    private function listarItensPeloCodigo(){
        echo "\nDigite o código para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->produtoPDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarItemPeloCodigo(){
        echo "\nDigite o código do produto que você deseja reativar: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->produtoPDO->reativarProdutoPeloId($produto->getId())){
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
        echo "\nDigite o código do produto que você deseja reativar: ";
        $produto = $this->produtoPDO->findById(rtrim(fgets(STDIN)));
        print_r($produto);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->produtoPDO->reativarProdutoPeloId($produto->getId())){
                echo "\nProduto reativado.";
            }else{
                echo "\nFalha ao reativar o produto. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }   
    }    
    
}
   
    



