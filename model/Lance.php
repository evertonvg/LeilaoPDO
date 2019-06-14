<?php

class Lance{
    
    private $id;
    private $lance;
    private $datahora;
    private $participante; //relação com participante
    private $item;//relação com Item_Leilao
    
    function __construct() {
        
    }
    
    function getId() {
        return $this->id;
    }

    function getLance() {
        return $this->lance;
    }

    function getDatahora() {
        return $this->datahora;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLance($lance) {
        $this->lance = $lance;
    }

    function setDatahora($datahora) {
        $this->datahora = $datahora;
    }
    
    function getParticipante() {
        return $this->participante;
    }

    function getItem() {
        return $this->item;
    }
    
    function setParticipante($participante) {
        $this->participante = $participante;
    }

    function setItem($item) {
        $this->item = $item;
    }

    
    public function __toString() {
        return "\nLance[id=$this->id, Lance=$this->lance, Data e hora=$this->datahora";
    }

}

