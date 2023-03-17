
<?php
    // Fábrica de conexões //
     class Conexao {
          private $usuario;
          private $senha;
          private $banco;
          private $servidor;

          private static $pdo;

          public function __construct(){
              
              $this->servidor = "localhost";
              $this->banco = "systec"; 
              $this->usuario = "root";
              $this->senha = "";
          }
          public function conectar(){
              try{// Verifica se não há nenhum problema na conexão //
                if(is_null(self::$pdo)){self::$pdo = new PDO("mysql:host=".$this->servidor.";dbname=".$this->banco, $this->usuario, $this->senha);
                echo "Conectou!!!"; // exibi mensagem conectou //  
                }
                return self::$pdo;
              }catch(PDOException $ex){
                  echo "ERRO: ".$ex->getMessage();  
              } 
          }
     
        }
