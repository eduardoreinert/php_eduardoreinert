<?php
    //conexao com o banco de dados
    $host='localhost';
    $dbname='db_imagens';
    $username='root';
    $password='';

    try{
        //conexao com o banco de dados usando PDO
        $pdo=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //define que erros vao lançar exceções

        //recupera todos os funcionarios do banco de dados
        $sql="SELECT id,nome FROM funcionarios";
        $stmt=$pdo->prepare($sql); //prepara a instrução sql para execução
        $stmt->execute(); //executa a instrução sql
        $funcionarios=$stmt->fetchAll(PDO::FETCH_ASSOC); //busca todos od resultados como uma matriz associativa

        //verifica se foi solicitado a exclusao de um funcionario
        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['excluir_id'])){
            $excluir_id=$_POST['excluir_id'];
            $sql_excluir="DELETE FROM funcionarios WHERE id=:id";
            $stmt_excluir=$pdo->prepare($sql_excluir);
            $stmt_excluir->bindParam(':id', $excluir_id, PDO::PARAM_INT);
            $stmt_excluir->execute();

            //redireciona para evitar reenvio do formulario
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        }
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage(); //exibe a mensagem de erro a conexao ou a consulta falhar
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de funcionário</title>
</head>
<body>
    <h1>Consulta de Funcionários</h1>

    <ul>
        <?php foreach($funcionarios as $funcionario): ?>
            <li>
                <!-- a linha abaixo exibe o link para visualizas os detalhes do funcionario com base no id -->
                <a href="visualizarFuncionario.php?id=<?=$funcionario['id']?>">
                    <!-- a linha abaixo exibe o nome do funcionario -->
                    <?=htmlspecialchars($funcionario['nome']) ?>
                </a>
                <!-- formulario para excluir funcionarios -->
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="excluir_id" value="<? =$funcionario['id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>