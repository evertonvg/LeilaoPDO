<?php

include_once "../model/participante.php";

include_once "../pdo/participantePDO.php";

include_once "../model/ItemLeilao.php";

include_once "../pdo/ItemLeilaoPDO.php";

include_once "../model/Lance.php";

include_once "../pdo/LancePDO.php";


class PedidoController {
    
    private $participantePDO;
    private $lancePDO;
    private $itemLeilaoPDO;

    public function __construct() {
        $this->pedidoPDO = new ParticipantePDO();
        $this->LancePDO = new lancePDO();
        $this->itemLeilaoPDO = new itemLeilaoPDO();
    }
    
    public function exibeMenu(){
         //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Pedido ---------";
                echo "\n1. Fazer um Lance (inserir lance): ";
                echo "\n2. Alterar lance ";
                echo "\n3. Excluir lance(soft delete): ";
                echo "\n4. Listar todos os lances ativos: ";
                echo "\n5. Listar todos os lances de um cliente: ";
                echo "\n6. Listar lances pelo código: ";
                echo "\n7. Reativar lance pelo código: ";
                echo "\nOpção (ZERO para sair): "; 
                $exit = fgets(STDIN);
                switch ($exit){
                    case 0:
                        break;
                    case 1:
                        $this->fazerLance();
                        break;
                    case 2:
                        $this->alterarLance();
                        break;
                    case 3:
                        $this->excluirLance();
                        break;
                    case 4:
                        $this->listarLances();
                        break;
                    case 5:
                        $this->listaLancesPorCliente();
                        break;
                    case 6:
                        $this->listaLancesPeloCodigo();
                        break;
                    case 7:
                        $this->reativarLancePeloCodigo();
                        break;
                    default:
                        echo "\nOpção inexistente.";
                }
        } //fim Menu
    }
    
    private function fazerLance(){
        $itens = Array();
        $totalPedido = 0;
        echo "\nSelecione o participante na lista abaixo digitando seu código";
        $participantes = $this->participantePDO->findAllWithoutDeleted();
        if($participantes != null){
            echo "\nLista de participantes cadastrados\n";
            print_r($participantes);
            echo "\nCódigo do participante: ";
            $participante = null;
            while($participante == null){
                $id = rtrim(fgets(STDIN));
                $participante = $this->participantePDO->findById($id);
                if($cliente != null){
                    echo "\nParticipante " . $participante->getNome() . " de id= " . $participante->getId() . " selecionado.";
                }else{
                    echo "\nNão foi possível selecionar este participante. Tente novamente.";
                }
            }
            $exit = -1;
            while($exit != 0){
                echo "\nSelecione o produto para venda na lista abaixo digitando seu código";
                $produtos = $this->produtoPDO->findAllWithoutDeleted();
                if($produtos != null && $exit != 0){
                    echo "\nLista de produtos cadastrados\n";
                    print_r($produtos);
                    echo "\nCódigo do produto: ";
                    $produto = null;
                    while($produto == null){
                        $id = rtrim(fgets(STDIN));
                        $produto = $this->produtoPDO->findById($id);
                        if($produto != null && $produto->getSituacao()){
                            echo "Produto " . $produto->getNome() . ", código = " . $produto->getId() . " selecionado.";
                            $item = new ItemPedido($produto);
                            echo "\nDigite a quantidade (no limite do estoque): ";
                            $quantidade = 0;
                            while($quantidade == 0){
                                $quantidade = rtrim(fgets(STDIN));
                                if($quantidade > $produto->getQuantidade() || $quantidade < 1){
                                    echo "\nDigite uma quantidade dentro do limite do estoque ou válida.";
                                    $quantidade = 0;
                                }else{
                                    $item->setQuantidade($quantidade);
                                }
                            }
                            $item->setTotalItem($quantidade * $produto->getValor());
                            $totalPedido += $item->getTotalItem();
                            array_push($itens, $item);
                        }else{
                            echo "\nNão foi possível selecionar este produto. Tente novamente.";
                        }
                    }
                }
                echo "\nVender mais produtos? (0 para sair)";
                $exit = rtrim(fgets(STDIN));
            }
            if(sizeof($itens) > 0){
                $pedido = new Pedido($itens);
                $pedido->setCliente($cliente);
                $pedido->setTotalPedido($totalPedido);
                $pedido->setFormaPagamento('dinheiro');
                if($this->pedidoPDO->insert($pedido)){ //salva o pedido
                    echo "\nPedido salvo.";
                }else{
                    echo "\nNão foi possível salvar este pedido.";
                }
            }else{
                echo "\nNenhum pedido foi emitido.";
            }

        }
    }
    
    private function faturarPedido(){
        echo "\nEm desenvolvimento.";
    }
    
    private function entregarPedido(){
        echo "\nEm desenvolvimento.";
    }
    
    private function excluirPedido(){
        echo "\nEm desenvolvimento.";
    }
    
    private function listarTodosPedidos(){
        echo "\nEm desenvolvimento.";
    }
    
    private function listarPedidoPorCliente(){
        echo "\nEm desenvolvimento.";
    }
    
    private function listarPedidoPorId(){
        echo "\nEm desenvolvimento.";   
    }
    
}//fim class




