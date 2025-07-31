<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Pesquisar Cliente</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Menu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li id="botoesNav" class="nav-item dropdown">
                    <button onclick="window.location.href='atualizarCliente.php'" id="botaoNav" type="button" class="btn btn-outline-secondary">Atualizar Cliente</button>
                    <button onclick="window.location.href='inserirCliente.php'" id="botaoNav" type="button" class="btn btn-outline-secondary">Inserir Cliente</button>
                    <button onclick="window.location.href='deletarCliente.php'" id="botaoNav" type="button" class="btn btn-outline-secondary">Deletar Cliente</button>
                    <button onclick="window.location.href='listarClientes.php'" id="botaoNav" type="button" class="btn btn-outline-secondary">Listar Cliente</button>
                    <button onclick="window.location.href='pesquisarCliente.php'" id="botaoNav" type="button" class="btn btn-outline-secondary">Pesquisar Cliente</button>
                </li>
            </ul>
        </div>
        </div>
</nav>
<h2 id="tit">Pesquisar Cliente</h2>
<?php
require_once 'conexao.php';

$conexao=conectarBanco();

$busca=$_GET['busca']??'';

if(!$busca){
    ?>
    <div class="row">
        <div id="formAtualizar" class="col-sm-4 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
            <form action="pesquisarCliente.php" method="GET">
                <label for="busca">Digite o ID ou Nome: </label>
                <input type="text" id="busca" name="busca" required>
                <button id="botaoForm" class="btn btn-primary" type="submit">Pesquisar</button>
            </form>

                
            </form>
            </div>
        </div>
    </div>
    
    <?php
    exit;
}

//Escolhe entre busca por Id ou Nome e faz a consulta diretamente
if(is_numeric($busca)){
    $stmt=$conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE id_cliente =:id");
    $stmt->bindParam(":id",$busca, PDO::PARAM_INT);
} else {
    $stmt=$conexao->prepare("SELECT id_cliente, nome, endereco, telefone, email FROM cliente WHERE nome LIKE :nome");
    $buscaNome="%$busca%";
    $stmt->bindParam(":nome",$buscaNome,PDO::PARAM_STR);
}

$stmt->execute();
$clientes=$stmt->fetchAll();

if(!$clientes){
    die("ero: Nenhum cliente encontrado.");
}
?>
<table id="tabList"class="table table-dark table-hover" border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Endereço</th>
        <th>Telefone</th>
        <th>E-mail</th>
        <th>Ação</th>
    </tr>
    <?php foreach($clientes as $cliente): ?>
    <tr>
        <td><?=htmlspecialchars($cliente['id_cliente']) ?></td>
        <td><?=htmlspecialchars($cliente['nome']) ?></td>
        <td><?=htmlspecialchars($cliente['endereco']) ?></td>
        <td><?=htmlspecialchars($cliente['telefone']) ?></td>
        <td><?=htmlspecialchars($cliente['email']) ?></td>
        <td><a class="btn btn-primary" href="atualizarCliente.php?id=<?=$cliente['id_cliente']?>">Editar</a></td>
    </tr>
    <?php endforeach; ?>
</table>

</body>