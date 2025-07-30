<?php
    require 'conexao.php';

    $conexao=conectarBanco();
    $stmt=$conexao->prepare("SELECT * FROM cliente");
    $stmt->execute();
    $clientes=$stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Lista de clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Menu</a>
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
    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
            <th>E-mail</th>
        </tr>
        <?php foreach($clientes as $cliente): ?>
        <tr>
            <td><?=htmlspecialchars($cliente["id_cliente"]) ?></td>
            <td><?=htmlspecialchars($cliente["nome"]) ?></td>
            <td><?=htmlspecialchars($cliente["endereco"]) ?></td>
            <td><?=htmlspecialchars($cliente["telefone"]) ?></td>
            <td><?=htmlspecialchars($cliente["email"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>