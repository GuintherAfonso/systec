<?php
require_once 'conexao.php';

class Clientes {
    private $id;
    private $nome;
    private $senha;
    private $telefone;
    private $email;
    private $cpf;

    private $con;

    public function __construct()
    {
        $this->con = new conexao();
    }

    public function adicionar($email, $nome, $senha, $telefone, $cpf)
    {
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) == 0) {
            try {
                $this->nome = $nome;
                $this->senha = $senha;
                $this->telefone = $telefone;
                $this->email = $email;
                $this->cpf = $cpf;
                $sql = $this->con->conectar()->prepare("INSERT INTO clientes(nome, senha, telefone, email, cpf) VALUES(:nome, :senha, :telefone, :email, :cpf)");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":senha", $senha);
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":cpf", $cpf);
                $sql->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return 'ERRO: ' . $ex->getMessage();
            }
        } else {
            return FALSE;
        }

    }
    private function existeEmail($email)
    {
        $sql = $this->con->conectar()->prepare("SELECT id FROM clientes WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        } else {
            $array = array();
        }
        return $array;
    }

    public function fazerLogin($email, $senha){
        $sql = $this->con->conectar()->prepare("SELECT * FROM clientes WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $sql = $sql->fetch();

            $_SESSION['logado'] = $sql['id'];
            return TRUE;
        }
        return FALSE;
    }

    public function listar(){
    
        try {
            $sql = $this->con->conectar()->prepare("SELECT id, nome, senha, telefone, email, cpf FROM clientes");
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $ex) {
            return 'ERRO: ' . $ex->getMessage();
        }
    }

    public function busca($id)
    {
        try {
            $sql = $this->con->conectar()->prepare("SELECT * FROM clientes WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetch();
            } else {
                return array();
            }
        } catch (PDOException $ex) {
            echo "ERRO:" . $ex->getMessage();
        }
    }

    public function editar($nome, $senha , $telefone, $email, $cpf, $id){
        $emailExistente = $this->existeEmail($email);
        if (count($emailExistente) > 0 && $emailExistente['id'] != $id) {
            return FALSE;
        } else {
            try {
                $sql = $this->con->conectar()->prepare("UPDATE clientes SET nome = :nome, senha = :senha, telefone = :telefone, email = :email, cpf = :cpf
            WHERE id = :id");
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':senha', $senha);
                $sql->bindValue(':telefone', $telefone);
                $sql->bindValue(':email', $email);
                $sql->bindValue(':cpf', $cpf);
                $sql->bindValue(':id', $id);
                $sql->execute();
                return TRUE;

            } catch (PDOException $ex) {
                echo "ERRO: " . $ex->getMessage();
            }
        }

    }

    public function excluir($id){
        $sql = $this->con->conectar()->prepare("DELETE FROM clientes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function setUsuario($id){
        $this->id = $id;
        $sql = $this->con->conectar()->prepare("SELECT * FROM clientes WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        if($sql->rowCount() > 0){
            
        }
    }
}