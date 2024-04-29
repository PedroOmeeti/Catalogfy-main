<?php 
  session_start();
  if (!isset($_SESSION['usuario'])) {
    // Voltar pro login:
    header("Location: index.php");
    die();
}

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('./classes/Produto.class.php');

    $p = new Produto();

    $p->id = strip_tags($_POST['id']);
  
    $antigo = $p->ListarFoto()[0]['foto'];
    
    $p->nome = strip_tags($_POST['nome']);
    $p->descricao = strip_tags($_POST['descricao']);
    $p->categoria_fk = strip_tags($_POST['categoria']);
    $p->estoque = strip_tags($_POST['estoque']);
    $p->preco = strip_tags($_POST['preco']);
    $p->usuario_fk = $_SESSION['usuario']['id'];
    
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $uploadOk = 1;   

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
  

    // Verificar o tamanho do arquivo
    if ($_FILES["foto"]["size"] > 500000) {
      echo "Seu arquivo é muito grande";
      $uploadOk = 0;
    }

    // Permitir certo tipos de arquivos
    if(empty($_FILES['foto']['size'])) {
      $uploadOk = 0;
     } elseif($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
      echo "Apenas arquivos JPG, JPEG, PNG & GIF são permitidos.";
      $uploadOk = 0;
    }

    // print_r($uploadOk);
    // die();

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      if($p->Modificarsemimagem() == 1) {
        header("Location: ../painel.php");
        die();

      } else {
        echo "<script>alert('erro')</script>";
      };
    // if everything is ok, try to upload file
    } else {
      $target_dir = "../imagens/";
        
        $novo_nome = hash_file('md5', $_FILES['foto']['tmp_name']). "." .$ext;
        $p->foto = $novo_nome;
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $novo_nome)) {
        
        if($p->Modificar() == 1) {
          if($antigo != 'semfoto.jpg') {
            unlink('../imagens/' . $antigo);
          }
          header("Location: ../painel.php");
          die();
        } else {
          echo "<script>alert('erro')</script>";
        }
      } else {
        echo "Falha ao cadastrar produto(foto)";
      }
    }
    
    
  } else {
    echo "Essa página deve ser carregada por post!";
  }








?>