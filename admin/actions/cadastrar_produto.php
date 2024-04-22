<?php 

  session_start();

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('./classes/Produto.class.php');

    $p = new Produto();

    $p->nome = strip_tags($_POST['nome']);
    
    $p->descricao = strip_tags($_POST['descricao']);
    $p->categoria_fk = strip_tags($_POST['categoria']);
    $p->estoque = strip_tags($_POST['estoque']);
    $p->preco = strip_tags($_POST['preco']);
    $p->usuario_fk = strip_tags($_POST['usuario']);

    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Verificar se a imagem é real ou fake
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["foto"]["tmp_name"]);
      if($check !== false) {
        echo "O arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
      }
    }

    // Verificar se o arquivo ja existe no servidor
    if (file_exists($target_file)) {
      echo "Este arquivo ja existe.";
      $uploadOk = 0;
    }

    // Verificar o tamanho do arquivo
    if ($_FILES["foto"]["size"] > 500000) {
      echo "Seu arquivo é muito grande";
      $uploadOk = 0;
    }

    // Permitir certo tipos de arquivos
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
      $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Desculpe, seu arquivo não foi enviado.";
    // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        
        $p->foto = ($_POST['foto']);
       
      } else {
        echo "Desculpe, ocorreu um erro ao enviar o seu arquivo.";
      }
    }



    if($p->Cadastrar() == 1) {
      header("Location: ../painel.php");
    } else {
      echo "<script>alert('erro')</script>";
    }
    
  } else {
    echo "Essa página deve ser carregada por post!";
  }








?>