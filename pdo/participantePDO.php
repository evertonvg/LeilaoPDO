<?php 

include_once "../model/Participante.php";

include_once "conexao.php";

class ParticipantePDO extends Conexao {
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($participante){
        try{
             $stmt = $this->conn->prepare("INSERT INTO participantes (nome, login, senha, email, endereco, telefone, admin, situacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
             $stmt->bindValue(1,$participante->getNome());
             $stmt->bindValue(2,$participante->getLogin());
             $stmt->bindValue(3,$participante->getSenha());
             $stmt->bindValue(4,$participante->getEmail());
             $stmt->bindValue(5,$participante->getEndereco());
             $stmt->bindValue(6,$participante->getTelefone());
             $stmt->bindValue(7,$participante->getAdmin());
             $stmt->bindValue(8,$participante->getSituacao());
             return $stmt->execute();
         }catch(Exception $ex){
             echo "\nExceção em participantePDO->insert:".$ex->getMessage();
             return false;
         }
    }
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM leilao.participantes ORDER BY nome");
            if($stmt->execute()){
            $participantes = Array();
            while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                array_push($participantes, $this->resultSetToParticipante($rs));
            }
            
            return $participantes;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe ProdutoPDO: " . $ex->getMessage();
        }
        
    }
    public function update($participante){
        try{
            $stmt = $this->conn->prepare("UPDATE clientes SET nome=?, login=?, situacao=? WHERE id = ?");
            $stmt->bindValue(1,$participante->getNome());
             $stmt->bindValue(2,$participante->getLogin());
             $stmt->bindValue(3,$participante->getSenha());
             $stmt->bindValue(4,$participante->getEmail());
             $stmt->bindValue(5,$participante->getEndereco());
             $stmt->bindValue(6,$participante->getTelefone());
             $stmt->bindValue(7,$participante->getAdmin());
             $stmt->bindValue(8,$participante->getSituacao());
             $stmt->bindValue(9,$participante->getId());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em ClientePDO->update: " . $ex->getMessage();
            return false;
        }
    }    
    
    public function deleteSoft(){
         try{
            $stmt = $this->conn->prepare("UPDATE participantes SET situacao=? WHERE id=?");
            $stmt->bindValue(1, false);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em participantePDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM participantes WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToParticipante($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe ClientePDO: " . $ex->getMessage();
            return null;
        }
    }
    
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM participantes ORDER BY nome");
            if($stmt->execute()){
                $participantes = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($participantes, $this->resultSetToParticipante($rs));
            }
            
            return $participantes;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe participantePDO: " . $ex->getMessage();
            return null;    
        }
        
    }
    
    public function findByNome($nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM participantes WHERE nome LIKE ? ORDER BY nome");
            $stmt->bindValue(1, $nome . '%');
            if ($stmt->execute()) {
                $participantes = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($participantes, $this->resultSetToParticipante($rs));
                }
                return $clientes;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe participantePDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM participantes WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToParticipante($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe participantePDO: " . $ex->getMessage();
            return null;
        }
    }
    
    public function findAllWithoutDeleted(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM participantes WHERE situacao = ? ORDER BY nome");
            $stmt->bindValue(1, true);
            if($stmt->execute()){
                $clientes = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($clientes, $this->resultSetToParticipante($rs));
            }
            
            return $clientes;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAllWithoutDeleted da classe participantePDO: " . $ex->getMessage();
            return null;    
        }
    }
    
     public function reativarClientePeloId($id){
        try{
            $stmt = $this->conn->prepare("UPDATE participantes SET situacao=? WHERE id=?");
            $stmt->bindValue(1, true);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em participantePDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    private function resultSetToParticipante($rs){
        $participante = new participante();
        $participante->setId($rs->id);
        $participante->setNome($rs->nome);
        $participante->setSenha($rs->senha);
        $participante->setEmail($rs->email);
        $participante->setEndereco($rs->endereco);
        $participante->setTelefone($rs->telefone);
        $participante->setAdmin($rs->admin);
        $participante->setSituacao($rs->situacao);
        return $participante;
    }
    
}
