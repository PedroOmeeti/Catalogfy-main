<?php
// Painel de administração
session_start();
if (!isset($_SESSION['usuario'])) {
    // Voltar pro login:
    header("Location: index.php");
    die();
}
require_once('./actions/classes/Categoria.class.php');
require_once('./actions/classes/Produto.class.php');

    $user = $_SESSION['usuario']['id'];

    $resultado = new Categoria();
    $listcategoria = $resultado->Listar();

    $resultadoprodutos = new Produto();
    $listproduto = $resultadoprodutos->ListarTudo();

    




?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem de Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        body {
            background: #f8f9fa;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gerenciamento de Produtos</h1>
        <div class="row mb-3">
            <div class="col d-flex justify-content-end">
                <button type="button" class="btn btn-success mx-1" data-toggle="modal" data-target="#modalCadastro"><i class="bi bi-plus-circle"></i> Cadastrar Produto</button>
                <a class="btn btn-danger mx-1 text-white" href="sair.php"><i class="bi bi-box-arrow-right"></i> Sair</a>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listproduto as $listgeral) { ?>
                <tr>
                    <td><?=$listgeral['id']; ?></td>
                    <td><img src="./imagens/<?=$listgeral['foto']; ?>" width="150px" height="150px"></td>
                    <td><?=$listgeral['nome']; ?></td>
                    <td><?=$listgeral['descricao']; ?></td>
                    <td><?=$listgeral['nomecategoria']; ?></td>
                    <td><?=$listgeral['estoque']; ?></td>
                    <td>R$ <?=$listgeral['preco']; ?></td>
                    <td><button type="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#modalEditar" data-nome="<?=$listgeral['nome']; ?>" data-foto="<?=$listgeral['foto']; ?>" data-descricao="<?=$listgeral['descricao']; ?>" data-categoria="<?=$listgeral['nomecategoria']; ?>" data-estoque="<?=$listgeral['estoque']; ?>" data-preco="<?=$listgeral['preco']; ?>"> Editar Produto</button><br><br><a class="btn btn-danger" href="./actions/excluir_produto.php?id=<?=$listgeral['id']; ?>">Excluir Produto</td>
                    <!-- <i class="bi bi-plus-circle"></i> -->
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

    <!-- Modal de Cadastro -->
    <form action="./actions/cadastrar_produto.php" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h5 class="modal-title" id="modalCadastroLabel">Cadastro de Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            
                            <label for="nomeProduto">Nome</label>
                            <input required type="text" class="form-control" id="nomeProduto" placeholder="Digite o nome do produto" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="fotoProduto">Foto</label>
                            <input type="file" class="form-control-file" id="fotoProduto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="descricaoProduto">Descrição</label>
                            <textarea required class="form-control" id="descricaoProduto" rows="3" name="descricao"></textarea>
                        </div> 
                        <div class="form-group">
                            <label for="categoriaProduto">Categoria</label>
                            <select class="form-control" id="categoriaProduto" name="categoria">
                               <?php foreach($listcategoria as $categoria) { ?> 
                                <option value="<?=$categoria['id']; ?>"><?=$categoria['nome'];?></option>
                               <?php } ?> 
                            </select> <br>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAddCategoria">Adicionar Categoria</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estoqueProduto">Estoque</label>
                            <input required type="number" class="form-control" id="estoqueProduto" placeholder="Digite a quantidade em estoque" name="estoque">
                        </div>
                        <div class="form-group">
                            <label for="precoProduto">Preço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input required type="number" class="form-control" id="precoProduto" placeholder="Digite o preço" name="preco">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="modal fade" id="modalAddCategoria" tabindex="-1" role="dialog" aria-labelledby="modalAddCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <form action="./actions/cadastrar_categoria.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddCategoriaLabel">Adicionar Categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nomeCategoria">Nome da Categoria</label>
                            <input type="text" class="form-control" id="nomeCategoria" placeholder="Digite o nome da categoria" name="nome">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->

    <form action="./actions/editar_produto.php" method="POST" enctype="multipart/form-data">
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h5 class="modal-title" id="modalEditarLabel">Editar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            
                            <label for="nomeProduto">Nome</label>
                            <input type="text" class="form-control nomeProduto" id="nomeProduto" placeholder="Digite o nome do produto" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="fotoProduto">Foto</label>
                            <img class="fotoProduto" src="" alt="" width="150px" height="150px">
                            <input type="file" class="form-control-file" id="fotoProduto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="descricaoProduto">Descrição</label>
                            <textarea class="form-control descricaoProduto" id="descricaoProduto" rows="3" name="descricao"></textarea>
                        </div> 
                        <div class="form-group">
                            <label for="categoriaProduto">Categoria</label>
                            <select class="form-control categoriaProduto" id="categoriaProduto" name="categoria">
                               <?php foreach($listcategoria as $categoria) { ?> 
                                <option value="<?=$categoria['id']; ?>"><?=$categoria['nome'];?></option>
                               <?php } ?> 
                            </select> <br>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAddCategoria">Adicionar Categoria</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="estoqueProduto">Estoque</label>
                            <input type="number" class="form-control estoqueProduto" id="estoqueProduto" placeholder="Digite a quantidade em estoque" name="estoque">
                        </div>
                        <div class="form-group">
                            <label for="precoProduto">Preço</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">R$</span>
                                </div>
                                <input type="number" class="form-control precoProduto" id="precoProduto" placeholder="Digite o preço" name="preco">
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
    </form>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $('#modalEditar').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) 
            var nome = button.data('nome') 
            var foto = button.data('foto') 
            var descricao = button.data('descricao')
            var categoria = button.data('categoria')
            var estoque = button.data('estoque')
            var preco = button.data('preco')
            var modal = $(this)
            modal.find('.nomeProduto').val(nome)
            modal.find('.fotoProduto').attr('src','imagens/'+foto)
            modal.find('.descricaoProduto').val(descricao)
            modal.find('.categoriaProduto').val(categoria)
            modal.find('.estoqueProduto').val(estoque)
            modal.find('.precoProduto').val(preco)
        })
    </script>
</body>

</html>