<?php

include_once "../model/Leilao.php";

include_once "Conexao.php";


class leilaoPDO extends Conexao {
    
    private $conn;
    
    public function __construct() {
        $this->conn = parent::getConexao();
    }
    
    public function insert($item){
        try{
            $stmt = $this->conn->prepare("INSERT INTO itens "
                . "(titulo, descricao, minimo, camninho_foto, arrematado, situacao) "
                . "VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $item->getTitulo_item());
            $stmt->bindValue(2, $item->getDescricao());
            $stmt->bindValue(3, $item->getLance_minimo());
            $stmt->bindValue(4, $item->getCaminho_foto());
            $stmt->bindValue(5, $item->getArrematado());
            $stmt->bindValue(6, $item->getSituacao());
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em itemLeilaoPDO->insert: " . $ex->getMessage();
            return false;
        }
    }
    
    public function update($item){
        try{
            $stmt = $this->conn->prepare("UPDATE itens SET titulo=?, descricao=?, "
                    . "minimo=?, camninho_foto=?, arrematado=?, situacao=? WHERE id = ?");
            $stmt->bindValue(1, $Item->getTitulo_item());
            $stmt->bindValue(2, $Item->getDescricao());
            $stmt->bindValue(3, $Item->getLance_minimo());
            $stmt->bindValue(4, $Item->getCaminho_foto());
            $stmt->bindValue(5, $Item->getArrematado());
            $stmt->bindValue(6, $Item->getSituacao());
            $stmt->bindValue(7, $Item->getId());
             
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em itemLeilaoPDO->update: " . $ex->getMessage();
            return false;
        }
    }

    public function deleteSoft($id){
        try{
            $stmt = $this->conn->prepare("UPDATE itens SET situacao=? WHERE id=?");
            $stmt->bindValue(1, false);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em itemLeilaoPDO->deleteSoft: " . $ex->getMessage();
            return false;
        }
    }
    
    public function reativarProdutoPeloId($id){
        try{
            $stmt = $this->conn->prepare("UPDATE itens SET situacao=? WHERE id=?");
            $stmt->bindValue(1, true);
            $stmt->bindValue(2, $id);
         
            return $stmt->execute();
            
        } catch (PDOException $ex) {
            echo "\nExceção em itemLeilaoPDO->reativarProdutoPeloId: " . $ex->getMessage();
            return false;
        }
    }
    
    public function findAll(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM itens ORDER BY titulo");
            if($stmt->execute()){
                $itens = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($itens, $this->resultSetToitem($rs));
                }
                return $itens;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe ItemLeilaoPDO: " . $ex->getMessage();
            return null;    
        }     
    }
    
    public function findAllWithoutDeleted(){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM itens WHERE situacao = ? ORDER BY titulo");
            $stmt->bindValue(1, true);
            if($stmt->execute()){
                $itens = Array();
                while($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    array_push($itens, $this->resultSetToitem($rs));
            }
            
            return $itens;
        }
        } catch (PDOException $ex) {
            echo "\nExceção no findAll da classe itemLeilaoPDO: " . $ex->getMessage();
            return null;    
        }
    }

    public function findByNome($nome){
        try{
            $stmt = $this->conn->prepare("SELECT * FROM itens WHERE titulo LIKE ? ORDER BY titulo");
            $stmt->bindValue(1, $nome . '%');
            if ($stmt->execute()) {
                $itens = Array();
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    array_push($itens, $this->resultSetToProduto($rs));
                }
                return $itens;
            }
            
        } catch (PDOException $ex) {
            echo "\nExceção no findByNome da classe itemLeilaoPDO: " . $ex->getMessage();
            return null;    
        }
    }
    
    public function findById($id) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM itens WHERE id=?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                if($rs = $stmt->fetch(PDO::FETCH_OBJ)){
                    return $this->resultSetToitem($rs);
                }else{
                    return null;
                }
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            echo "\nExceção no findById da classe itemLeilaoPDO: " . $ex->getMessage();
            return null;
        }
    }
    
    private function resultSetToLeilao($rs){
        $leilao = new Leilao($this->ItemleilaoPDO->findById($rs->idItem));
        $leilao->setId($rs->id);
        $leilao->setDt_inicio($rs->dtInicio);
        $leilao->setDt_final($rs->dtFinal);
        $leilao->setHor_inicio($rs->hrInicio);
        $leilao->setHor_final($rs->hrFinal);
        $leilao->setSituacao($rs->situacao);
        
        return $leilao;
    }
    
}


