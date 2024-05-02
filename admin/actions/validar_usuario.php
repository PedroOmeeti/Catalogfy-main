<?php
session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    require_once('classes/Usuario.class.php');
    $u = new Usuario();
    $u->email = strip_tags($_POST['email']);
    $u->senha = strip_tags($_POST['senha']);
    $resultado = $u->Logar();
    if(count($resultado) == 1){
        // Criar a sessão:
        session_start();
        $_SESSION['usuario'] = $resultado[0];
        // Redirecionar pro index.php (página do usuário):
        header("Location: ../../");
        die();
    }else{
       header('Location: ../index.php?erro=loginfalha');
    }

}else{
    echo "Essa página deve ser carregada por POST.";
}



?>