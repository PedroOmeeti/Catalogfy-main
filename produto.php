<?php
// Página com detalhes do produtos selecionado.
// ex: produto.php?id=25
  session_start();

  require_once('./admin/actions/classes/Produto.class.php');
  $resultadoprodutos = new Produto();

  $resultadoprodutos->id = strip_tags($_GET['id']);
  $listproduto = $resultadoprodutos->ListarInfos()[0];


?>

<!doctype html>
<html lang="en">

<head>
  <title>Detalhes do Produto</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <?php 
    include_once('cabecalho.php');
  ?>

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1 class="display-5">Detalhes do Produto</h1>
        </div>
    </div>
    <!-- Detalhes do Produto selecionado: -->
    <div class="row mt-5">
        <div class="col-7">
            <img class="rounded mx-auto d-block" src="admin/imagens/<?=$listproduto['foto']; ?>"/>
        </div>
        <div class="col-5">
            <h2><?=$listproduto['nome']; ?></h2>
            <p><?=$listproduto['descricao']; ?></p>
            <h1 class="display-6">R$ <?=$listproduto['preco']; ?></h1>
            <a href="index.php"><small class="text-muted">Voltar</small></a>
        </div>
    </div>
   
</div>

<div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <div class="col-md-4 d-flex align-items-center">
      <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
      </a>
      <span class="text-muted">&copy; 2029 Senacão Show</span>
    </div>

    <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
      <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
    </ul>
  </footer>
</div>



  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>