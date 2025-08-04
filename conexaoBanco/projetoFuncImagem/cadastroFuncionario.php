<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionário</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        <h2>Funcionário</h2>
        <!-- formulario para cadastrar um funcionario -->
        <form action="salvarFuncionario.php" method="POST" enctype="multipart/form-data">
            <!-- campo para inserir o nome do funcionario -->
            <label for="nome">Nome: </label>
            <input type="text" name="nome" id="nome" required>
            </br>
            <!-- campo para inserir o telefone do funcionario -->
            <label for="telefone">Telefone: </label>
            <input type="text" name="telefone" id="telefone" required>
            </br>
            <!-- campo para fazer upload da foto do funcionario -->
            <label for="foto">Foto: </label>
            <input type="file" name="foto" id="foto" required>
            </br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>