<?php
// Página inicial do site para listagem de produtos cadastrados.
session_start();

require_once('./admin/actions/classes/Categoria.class.php');
require_once('./admin/actions/classes/Produto.class.php');

    $resultado = new Categoria();
    $listcategoria = $resultado->Listar();

    $resultadoprodutos = new Produto();
    $listproduto = $resultadoprodutos->ListarTudo();

?>
<!doctype html>
<html lang="en">

<head>
  <title>Página Inicial</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <style>
      .seila {
        min-height: 72px !important;
        /* height: ; */
      }
    </style>

</head>

<body>
    <?php 
        include_once('cabecalho.php');
    ?>

<div class="container">
    <div class="row mt-3">
        <div class="col">
            <h1 class="display-5">Listagem de Produtos</h1>
        </div>
    </div>
    <!-- Listagem de produtos: 4 por linha: -->
    
        <div class="row mt-5">
        <?php foreach($listproduto as $list) { ?>
            <div class="col-3">
                <div class="card my-3">
                    <a href="#"><img class="card-img-top" height="300px" width="300px" src="./admin/imagens/<?=$list['foto']; ?>" alt="Imagem"></a>
                    <div class="card-body">
                        <h4 class="card-title"><?=$list['nome']; ?></h4>
                        <p class="card-text seila"><?=substr($list['descricao'], 0,70) . "..."; ?>
                            <div class="d-grid gap-2">
                            <a href="produto.php?id=<?=$list['id']; ?>" class="btn btn-primary">Mais detalhes...</a>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        
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