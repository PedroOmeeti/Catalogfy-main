<?php
session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once('./classes/Categoria.class.php');
    $u = new Categoria();
    $u->nome = strip_tags($_POST['nome']);
    if($u->Cadastrar() == 1){
        // Deu certo heheheh
        // Redirecionar de volta ao login:
        header("Location: ../painel.php");
    }else{
        echo "Falha ao cadastrar categoria";
    }
}else{
    echo "Essa página dever ser carregada por post!";
}

?>