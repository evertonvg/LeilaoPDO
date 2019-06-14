<?php


class Conexao{ 
    //usar public quando for usar con
    public function getConexao(){
        try {
            $conn = new PDO('mysql:host=localhost;dbname=leilao', 'root', '');//'mysql: dbname=vendas;user=root; password=""; host=localhost; port=3306;');
            $conn->setAttribute(PDO::ATTR_ERRMODE, 
                    PDO::ERRMODE_EXCEPTION); //define para que o PDO lance exceções na ocorrência de erros
           // print_r($conn);
           //print_r($conn->getAvailableDrivers());
            
            return $conn;
                    
        } catch (PDOException $ex) {
            echo '<script>alert("Erro de conexao com o banco de dados\n");</script>';
            echo $ex->getFile() . ' ### ' . $ex->getLine() . ' ### ' . $ex->getMessage() . ' ### ' . $ex->getCode();
        
            return null;
        }
    }
}
//testagem da conexão
// $con = new Conexao();
 //$con->getConexao();




