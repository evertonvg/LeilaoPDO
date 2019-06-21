<?php
include_once "../model/Participante.php";

include_once "../pdo/participantePDO.php";


class participanteController{
    
    private $participantePDO;
    
    public function __construct() {
        $this->participantePDO = new ParticipantePDO();
    }
    
    public function exibeMenu(){
        //Um front em modo texto controlado por Menu
        $exit = 1;
        while ($exit != 0){
            echo "\n\n--------- Submenu Cliente ---------";
            echo "\n1. Inserir Participante";
            echo "\n2. Alterar Participante";
            echo "\n3. Excluir Participante (soft delete)";
            echo "\n4. Listar todos os Participantes mesmo com situação desativada";
            echo "\n5. Listar Participante pelo nome";
            echo "\n6. Listar Participante pelo código";
            echo "\n7. Reativar Participante pelo código";
            echo "\n8. Listar todos os participantes que estão com situação ativa";
            echo "\nOpção (ZERO para sair): "; 
            $exit = fgets(STDIN);
            switch ($exit){
                case 0:
                    break;
                case 1:
                    $this->regPar();
                    break;
                case 2:
                    $this->alterarParticipante();
                    break;
                case 3:
                    $this->excluirParticipante();
                    break;
                case 4:
                    $this->listarTodosParticipante();
                    break;
                case 5:
                    $this->listarParticipantePeloNome();
                    break;
                case 6:
                    $this->listarParticipantePeloCodigo();
                    break;
                case 7:
                    $this->reativarParticipantePeloCodigo();
                    break;
                case 8:
                    $this->listarparticipantesAtivos();
                    break;
                default:
                    echo "\nOpção inexistente.";
            }
        } //fim Menu
    }
    
    //inserir (case 1)
    private function regPar(){
        $participante = new Participante();
        
        echo"\nNome do participante ";
        $participante->setNome(rtrim(fgets(STDIN)));
        
        echo"\nLogin  do participante: ";
        $participante->setLogin(rtrim(fgets(STDIN)));
        
        echo"\nSenha  do participante: ";
        $participante->setSenha(rtrim(fgets(STDIN))); 
        
        echo"\nEmail do participante: ";
        $participante->setEmail(rtrim(fgets(STDIN))); 
        
        echo"\nEndereço do participante: ";
        $participante->setEndereco(rtrim(fgets(STDIN)));
        
        echo"\nTelefone do participante: ";
        $participante->setTelefone(rtrim(fgets(STDIN)));
        
        $participante->setAdmin(false);
        
        $participante->setSituacao(true); //nasce como registro válido no bd
        
        if($this->participantePDO->insert($participante)){
            echo "\nParticipante salvo.";
        }else{
            echo "\nErro ao salvar. Contate o administrador do sistema.";
        }
    }
    
    //update (case 2)
    private function alterarParticipante(){
        echo "\nDigite o código do cliente que você deseja alterar: ";
        $participante = $this->participantePDO->findById(rtrim(fgets(STDIN)));
        if($participante != null){
            print_r($participante);
            
            echo "\nDigite o nome do participante: ";
            $nome = fgets(STDIN);
            if($nome != "\n"){
                $participante->setNome(rtrim($nome));
            }
            
            echo"\nlogin do participante: ";
            $login = fgets(STDIN);
            if($login != "\n"){
                $participante->setLogin(rtrim($login));
            }
            
            echo"\nsenha do participante: ";
            $senha = fgets(STDIN);
            if($senha != "\n"){
                $participante->setSenha(rtrim($senha));
            }
            
            echo"\nemail do participante: ";
            $email = fgets(STDIN);
            if($email != "\n"){
                $participante->setEmail(rtrim($senha));
            }
            
            echo"\nendereço do participante: ";
            $endereco = fgets(STDIN);
            if($endereco != "\n"){
                $participante->setEndereco(rtrim($senha));
            }
            
            echo"\ntelefone do participante: ";
            $telefone = fgets(STDIN);
            if($telefone != "\n"){
                $participante->setTelefone(rtrim($telefone));
            }
            
            $situacao = true;
            $participante->setSituacao($situacao);
             
            $admin = false;
            $participante->setAdmin(rtrim(admin));
             
            if($this->participantePDO->update($participante)){
                echo "\nParticipante alterado.";
            }else{
                echo "\nErro ao alterar o participante. Contate o administrador do sistema.";
            }
        }else{
            echo "\nNão há participantes cadastrados com esse código.";
        }
    }
    
    //update (case 3)
    private function excluirParticipante(){
        echo "\nDigite o código do participante que você deseja tornar inativo: ";
        $participante = $this->participantePDO->findById(rtrim(fgets(STDIN)));
        print_r($participante);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->participantePDO->deleteSoft($participante->getId())){
                echo "\nparticipante excluído.";
            }else{
                echo "\nFalha ao reativar o participante. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }
    }

    //findAll ou SELECT sem filtros (case 4)
    private function listarTodosParticipante(){
        print_r($this->participantePDO->findAll());
    }
    
    //find for name ou SELECT com filtros (case 5)
    private function listarParticipantePeloNome(){
        echo "\nDigite o nome para pesquisa: ";
        $nome = rtrim(fgets(STDIN));   
        print_r($this->participantePDO->findByNome($nome));
    }
    
    //find for id ou SELECT com filtros (case 6)
    private function listarParticipantePeloCodigo(){
        echo "\nDigite o código para pesquisa: ";
        $codigo = rtrim(fgets(STDIN));
        print_r($this->participantePDO->findById($codigo));
    }
    
    //update (case 7)
    private function reativarParticipantePeloCodigo(){
        echo "\nDigite o código do participante que você deseja reativar: ";
        $participante = $this->participantePDO->findById(rtrim(fgets(STDIN)));
        print_r($participante);
        echo "\nConfirmar a operação (s/n)? ";
        $operacao = rtrim(fgets(STDIN));
        
        if(!strcasecmp($operacao, "s")){
            if($this->participantePDO->reativarClientePeloId($participante->getId())){
                echo "\nparticipante reativado.";
            }else{
                echo "\nFalha ao reativar o participante. Contate o administrador do sistema.";
            }       
        }
        if(!strcasecmp($operacao, "n")){
            echo "\nOperação cancelada.";
        }  
    }
    
    private function listarparticipantesAtivos(){
        print_r($this->participantePDO->findAllWithoutDeleted());
    }
}







