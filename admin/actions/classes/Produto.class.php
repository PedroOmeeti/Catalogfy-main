<?php

  require_once("Banco.class.php");

  class Produto {
    public $id;
    public $nome;
    public $descricao;
    public $categoria_fk;
    public $estoque;
    public $preco;
    public $foto;
    public $usuario_fk;

    public function Cadastrar() {
      $sql = "INSERT INTO produtos (nome, descricao, id_categoria, estoque, preco, foto, id_resp) VALUE (?,?,?,?,?,?,?)";
      $conexao = Banco::conectar();
      $comando = $conexao->prepare($sql);

      $comando->execute([$this->nome, $this->descricao, $this->categoria_fk, $this->estoque, $this->preco, $this->foto, $this->usuario_fk]);
      $linhas = $comando->rowCount();

      Banco::desconectar();
      return($linhas);
      
    }

    public function CadastrarsImg() {
      $sql = "INSERT INTO produtos (nome, descricao, id_categoria, estoque, preco, id_resp) VALUE (?,?,?,?,?,?)";
      $conexao = Banco::conectar();
      $comando = $conexao->prepare($sql);

      $comando->execute([$this->nome, $this->descricao, $this->categoria_fk, $this->estoque, $this->preco, $this->usuario_fk]);
      $linhas = $comando->rowCount();

      Banco::desconectar();
      return($linhas);

    }

    public function ListarTudo() {
      $sql = "SELECT * FROM produtos_completo";
      $conexao = Banco::conectar();
      $comando = $conexao->prepare($sql);

      $comando->execute();
      $linhas = $comando->fetchAll(PDO::FETCH_ASSOC);

      Banco::desconectar();
      return($linhas);

    }

    public function Deletar() {
      $sql = "DELETE FROM produtos WHERE id = ?";
      $conexao = Banco::conectar();
      // Converter o comando sql (string) em um objeto
      $comando = $conexao->prepare($sql);
  
      // Executar o comando
      $comando->execute([$this->id]);
      $linhas = $comando->rowCount();
      // Desconectar
      Banco::desconectar();
      // Retornar a quantidade de linhas cadastradas
      return $linhas;
  
    }

    public function Modificar() {
      $sql = "UPDATE produtos SET nome=?, descricao=?, id_categoria=?, estoque=?, preco=?, foto=?  WHERE id=?";
      $conexao = Banco::conectar();
      // Converter o comando sql (string) em um objeto
      $comando = $conexao->prepare($sql);
  
      // Executar o comando
      $comando->execute([$this->nome, $this->descricao, $this->categoria_fk, $this->estoque, $this->preco, $this->foto, $this->id]);
      $linhas = $comando->rowCount();
      // Desconectar
      Banco::desconectar();
      // Retornar a quantidade de linhas cadastradas
      return $linhas;
    }

    public function Modificarsemimagem() {
      $sql = "UPDATE produtos SET nome=?, descricao=?, id_categoria=? estoque=?, preco=? WHERE id=?";
      $conexao = Banco::conectar();
      // Converter o comando sql (string) em um objeto
      $comando = $conexao->prepare($sql);
  
      // Executar o comando
      $comando->execute([$this->nome, $this->descricao, $this->categoria_fk, $this->estoque, $this->preco, $this->id]);
      $linhas = $comando->rowCount();
      // Desconectar
      Banco::desconectar();
      // Retornar a quantidade de linhas cadastradas
      return $linhas;
    }

    public function ListarFoto() {
      $sql = "SELECT foto FROM produtos WHERE id = ?";
      $conexao = Banco::conectar();
      $comando = $conexao->prepare($sql);

      $comando->execute([$this->id]);
      $linhas = $comando->fetchAll(PDO::FETCH_ASSOC);

      Banco::desconectar();
      return($linhas);

    }

  }






?>