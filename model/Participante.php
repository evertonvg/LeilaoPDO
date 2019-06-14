<?php

class Participante{

    private $id;
    private $nome;
    private $login;
    private $senha;
    private $email;
    private $endereco;
    private $telefone;
    private $admin;
    private $situacao;
    
    //private $lances = Array(); //relação com Lance

    public function __construct() {
        
    }
    
    function getSituacao() {
        return $this->situacao;
    }
    
    function setSituacao($situacao) {
        $this->situacao = $situacao;
    }

    function getAdmin() {
        return $this->admin;
    }
    
    function setAdmin($admin) {
        $this->admin = $admin;
    }

    //function getLances() {
     //   return $this->lances;
    //}

   // function setLances($lances) {
    //    $this->lances = $lances;
    //}

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getLogin() {
        return $this->login;
    }

    function getSenha() {
        return $this->senha;
    }

    function getEmail() {
        return $this->email;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getTelefone() {
        return $this->telefone;
    }
    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
 
    public function __toString() {
        return "\nParticipante[id=$this->id, Nome=$this->nome, Login=$this->login, Senha=$this->senha, Email=$this->email, Endereco=$this->endereco, Telefone=$this->telefone], Admin=$this->admin, situação=$this->situacao";
    }
    //" . print_r($lances)."
}
