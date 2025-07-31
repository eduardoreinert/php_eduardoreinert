<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Início</title>
</head>
<body>
    <main>
    <header><h2>EXEMPLO DE CRUD</h2></header>
    <h1>BEM-VINDO!(A)</h1>
    <div class="row">
        <div id="quadrado1" class="col-sm-4 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Atualizar Cliente</h5>
              <p class="card-text">Pesquisa cliente para alterar suas informações.</p>
              <a href="atualizarCliente.php" class="btn btn-primary">Ir</a>
            </div>
          </div>
        </div>
        <div id="quadrado2" class="col-sm-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Deletar Cliente</h5>
              <p class="card-text">Pesquisa cliente para deletar suas informações.</p>
              <a href="deletarCliente.php" class="btn btn-primary">Ir</a>
            </div>
          </div>
        </div>
        <div id="quadrado3" class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Inserir Cliente</h5>
                <p class="card-text">Adiciona novos clientes.</p>
                <a href="inserirCliente.php" class="btn btn-primary">Ir</a>
              </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="quadrado4" class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Listar Cliente</h5>
                <p class="card-text">Apresenta todos os clientes e suas informações.</p>
                <a href="listarClientes.php" class="btn btn-primary">Ir</a>
              </div>
            </div>
        </div>
        <div id="quadrado5" class="col-sm-4 mb-3 mb-sm-0">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pesquisar Cliente</h5>
                <p class="card-text">Pesquisa cliente para apresentar suas informações.</p>
                <a href="pesquisarCliente.php" class="btn btn-primary">Ir</a>
              </div>
            </div>
        </div>
    </div>
    </main>
    <footer><h6>Eduardo Borsato Reinert | Téc. Desenvolvimento de sistemas | DESN20242v1</h6></footer>
</body>
</html>