<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <title>Cadastro</title>
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

    <?php
    require 'conexao.php';

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $conexao = conectarBanco();

        $id=filter_var($_POST["id_cliente"], FILTER_SANITIZE_NUMBER_INT);
        $nome=htmlspecialchars(trim($_POST["nome"]));
        $endereco=htmlspecialchars(trim($_POST["endereco"]));
        $telefone=htmlspecialchars(trim($_POST["telefone"]));
        $email=filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

        if(!$id || !$email){
            die("Erro: ID inválido ou e-mail incorreto.");
        }

        $sql="UPDATE cliente SET nome=:nome, endereco=:endereco, telefone=:telefone, email=:email WHERE id_cliente=:id";

        $stmt=$conexao->prepare($sql);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":telefone", $telefone);
        $stmt->bindParam(":email", $email);

        try{
            $stmt->execute();
            echo "<p id='msgSucesso'>Cliente atualizado com sucesso!</p>";
        } catch(PDOException $e){
            error_log("Erro ao atualizar cliente.".$e->getMessage());
            echo "Erro ao atualizar registro.";
        }
    }
    ?>

<button onclick="window.location.href='atualizarCliente.php'" id="botaoNovo" type="button" class="btn btn-primary">Nova Atualização</button>
</body>
</html>