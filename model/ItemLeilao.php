<?php

class Item_Leilao{
    
    private $id;
    private $titulo_item;
    private $descricao;
    private $lance_minimo;
    private $caminho_foto;
    private $arrematado;
    private $situacao;
    
    private $lances = Array(); //relação com Lance
    //private $leilao; //relação com leilão
    
    function __construct() {
        
    }
    
    function getSituacao() {
        return $this->situacao;
    }

    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    
    function getId() {
        return $this->id;
    }

    function getTitulo_item() {
        return $this->titulo_item;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function getLance_minimo() {
        return $this->lance_minimo;
    }

    function getCaminho_foto() {
        return $this->caminho_foto;
    }

    function getArrematado() {
        return $this->arrematado;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitulo_item($titulo_item) {
        $this->titulo_item = $titulo_item;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    function setLance_minimo($lance_minimo) {
        $this->lance_minimo = $lance_minimo;
    }

    function setCaminho_foto($caminho_foto) {
        $this->caminho_foto = $caminho_foto;
    }

    function setArrematado($arrematado) {
        $this->arrematado = $arrematado;
    }
    
    function getLances() {
        return $this->lances;
    }

    function getLeilao() {
        return $this->leilao;
    }

    function setLances($lances) {
        $this->lances = $lances;
    }

    function setLeilao($leilao) {
        $this->leilao = $leilao;
    }

    public function __toString() {
        return "\nItem[id=$this->id, Titulo=$this->titulo_item, Descricao=$this->descricao, Lance Minimo=$this->Lance_minimo, Caminho da foto=$this->caminho_foto, Arrematado=$this->arrematado";
    }
    
 

}

