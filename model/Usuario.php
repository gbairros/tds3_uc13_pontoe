<?php
require_once ("../infra/Database.php");

class Usuario
{
    private $id;
    private $login;
    private $senha;
    private $nome;
    private $sobrenome;
    private $email;

    public function __set($atributo, $valor)
    {
        if (property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }

    public function __get($atributo)
    {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
    }

    public function salvar(){
        $db = new Database();
        $con = $db->connect();

        $sql = "INSERT INTO usuario(nome, sobrenome, email, login, senha) 
                VALUES (:nome, :sobrenome, :email, :login, :senha)";
        
        $st = $con->prepare($sql);
        $st->bindParam(':nome', $this->nome);
        $st->bindParam(':sobrenome', $this->sobrenome);
        $st->bindParam(':email', $this->email);
        $st->bindParam(':login', $this->login);
        $st->bindParam(':senha', $this->senha);
	    $status = $st->execute();

        $idUsuario = $con->lastInsertId();

        if ($status == true){
            return true;
        }

    }


    public function buscarPorId($id)
    {
        $db = new Database();
        $con = $db->connect();

        $sql = "SELECT id, nome, sobrenome, email, login FROM usuario WHERE id = :id";
        $st = $con->prepare($sql);
        $st->bindParam(':id', $id);

        $resultado = $st->execute();

        $dados = $st->fetchAll();
        $db->close();
        return $dados;
    }


    public function deletar($id)
    {
        $db = new Database();
        $con = $db->connect();

        $sql = "DELETE FROM usuario WHERE id = :id";
        $st = $con->prepare($sql);
        $st->bindParam(':id', $id);

        $status = $st->execute();

        $db->close();
        return  true;
    }


    public function listarTodos($pagina = null, $contador = 100)
    {
        $db = new Database();
        $con = $db->connect();

        $sql = "SELECT id, nome, sobrenome, email, login FROM usuario limit $contador";
        $rs = $con->query($sql);

        $status = $rs->execute();
        $dados = $rs->fetchAll();

        $db->close();
        return $dados;
    }


    public function autenticar($login, $senha)
    {
        $senha_cripto = hash("sha3-256", $senha);
        $database = new Database();
        $con = $database->connect();

        $sql = "SELECT id, login FROM usuario WHERE login = :login AND senha = :senha";

        $st = $con->prepare($sql);
        $st->bindParam(':login', $login);
        $st->bindParam(':senha', $senha_cripto);
        $retorno = $st->execute();
        $dados = $st->fetchAll();

        if (sizeof($dados) == 1){
            return true;
        }
        else{
            return false;
        }
    }

    public function atualizar(){
        $db = new Database();
        $con = $db->connect();

        $sql = "UPDATE usuario set nome = :nome, sobrenome = :sobrenome, email = :email, 
                    login = :login WHERE id = :id";
        
        $st = $con->prepare($sql);
        $st->bindParam(':nome', $this->nome);
        $st->bindParam(':sobrenome', $this->sobrenome);
        $st->bindParam(':email', $this->email);
        $st->bindParam(':login', $this->login);
        $st->bindParam(':id', $this->id);
	    
        $status = $st->execute();
        

        if ($status == true){
            return true;
        }
        else{
            return false;
        }

    }
}
