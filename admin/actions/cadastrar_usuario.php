<?php
session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once('./classes/Usuario.class.php');
    $u = new Usuario();
    $u->nome = strip_tags($_POST['nome']);
    $u->email = strip_tags($_POST['email']);
    $u->senha = strip_tags($_POST['senha']);
    if($u->Cadastrar() == 1){
        // Deu certo heheheh
        // Redirecionar de volta ao login:
        header("Location: ../index.php");
    }else{
        echo "Falha ao cadastrar usuario";
    }
}else{
    echo "Essa página deve ser carregada por post!";
}

?>