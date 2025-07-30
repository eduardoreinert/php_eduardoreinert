<?php
require_once 'conexao.php';

$conexao=conectarBanco();

//obtendo o ID via GET
$idCliente=$_GET['id'] ?? null;
$cliente=null;
$msgErro="";

//funçao local para buscar cliente por IS
function buscarClientePorId($idCliente, $conexao){
    $stmt=$conexao->prepare("SELECT id_cliente,nome,endereco,telefone,email FROM cliente WHERE id_cliente=:id");
    $stmt->bindParam(":id",$idCliente,PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

//se um ID foi enviado, busca o liente no banco
if($idCliente && is_numeric($idCliente)){
    $cliente=buscarClientePorId($idCliente,$conexao);

    if(!$cliente){
        $msgErro="Erro: Cliente não encontrado.";
    }
} else {
    $msgErro="Digite o ID do cliente para buscar os dados.";
}
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
    <title>Atualizar Cliente</title>
    <script>
        function habilitarEdicao(campo){
            document.getElementById(campo).removeAttribute("readonly");
        }
    </script>
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
    <h2 id="tit">Atualizar Cliente</h2>

    <!-- Se houver erro, exibe a mensagem e o campo de busca -->
     <?php if($msgErro): ?>
        <div class="row">
        <div id="formAtualizar" class="col-sm-4 mb-3 mb-sm-0">
          <div class="card">
            <div class="card-body">
                <p id="msgErro" style="color:red;"><?=htmlspecialchars($msgErro)?></p>

                <form action="atualizarCliente.php" method="GET">
                    <label for="id">ID do cliente:</label>
                    <input type="number" id="id" name="id" required>
                    <button id="botaoForm" class="btn btn-primary" type="submit">Buscar</button>
                </form>
            </div>
          </div>
        </div>
        
        <?php else: ?>
            <!--Se um cliente foi encontrado, exibe o formulário preenchido -->
            <div class="row">
            <div id="formAtualizar" class="col-sm-4 mb-3 mb-sm-0">
                <div class="card">
                    <div class="card-body">
                        <p style="color:red;"><?=htmlspecialchars($msgErro)?></p>

                        <form action="processarAtualizacao.php" method="POST">
                            <input type="hidden" name="id_cliente" value="<?=htmlspecialchars($cliente['id_cliente'])?>">
                            <table>
                            
                                <tr>
                                    <label for="nome">Nome: </label>
                                    <input type="text" id="nome" name="nome" value="<?=htmlspecialchars($cliente['nome'])?>"readonly onclick="habilitarEdicao('nome')">
                                </tr>
                                <tr>
                                    <label for="endereco">Endereço: </label>
                                    <input type="text" id="endereco" name="endereco" value="<?=htmlspecialchars($cliente['endereco'])?>"readonly onclick="habilitarEdicao('endereco')">
                                </tr>
                                <tr>
                                    <label for="telefone">Telefone: </label>
                                    <input type="text" id="telefone" name="telefone" value="<?=htmlspecialchars($cliente['telefone'])?>"readonly onclick="habilitarEdicao('telefone')">
                                </tr>
                                <tr>
                                    <label for="email">E-mail: </label>
                                    <input type="email" id="email" name="email" value="<?=htmlspecialchars($cliente['email'])?>"readonly onclick="habilitarEdicao('email')">
                                </tr>
                           
                            </table>
                            <button id="botaoForm" class="btn btn-primary" type="submit">Atualizar Cliente</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            
        <?php endif; ?>
</body>
</html>