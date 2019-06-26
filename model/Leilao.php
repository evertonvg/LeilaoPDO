<?php

class Leilao{
   
   private $id;
   private $dt_inicio;
   private $hor_inicio;
   private $dt_final;
   private $hor_final;
   private $situacao;
   
   private $item; //assosiação com item_leilao
   
   function __construct($item) {
       $this->item = $item; //composição
   }
   
   function getId() {
       return $this->id;
   }
   
   function setId($id) {
       $this->id = $id;
   }
   
   function getSituacao() {
       return $this->situacao;
   }

   function setSituacao($situacao) {
       $this->situacao = $situacao;
   }

      function getDt_inicio() {
       return $this->dt_inicio;
   }

   function getHor_inicio() {
       return $this->hor_inicio;
   }

   function getDt_final() {
       return $this->dt_final;
   }

   function getHor_final() {
       return $this->hor_final;
   }

   function setDt_inicio($dt_inicio) {
       $this->dt_inicio = $dt_inicio;
   }

   function setHor_inicio($hor_inicio) {
       $this->hor_inicio = $hor_inicio;
   }

   function setDt_final($dt_final) {
       $this->dt_final = $dt_final;
   }

   function setHor_final($hor_final) {
       $this->hor_final = $hor_final;
   }

    public function __toString() {
        return "\nLeilao[id=$this->id, Data de inicio=$this->dt_inicio, Data final=$this->dt_final, Hora de inicio=$this->hor_inicio, Hora final=$this->hor_final, sutucação=$this->situacao";
    }
}



