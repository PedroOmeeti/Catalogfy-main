<?php 

  // Verificar a sessão:
    session_start();
    if(!isset($_SESSION['usuario'])) {
      // Voltar pro login:
      header("Location: ../index.php");
      die();

    }

    if(isset($_GET['id'])) {
      require_once('./classes/Produto.class.php');


      $p = new Produto();
      $p->id = $_GET['id'];
      $result = $p->ListarFoto()[0]['foto'];
      
      
      if($p->Deletar() == 1) {
        if($result != 'semfoto.jpg') {
          unlink('../imagens/' . $result);
        }
        // Redirecionar:
        header('Location: ../painel.php');

      } else {
        echo "erro ao deletar";

      }

    } else {
      echo 'o id deve ser informado';
    }



?>