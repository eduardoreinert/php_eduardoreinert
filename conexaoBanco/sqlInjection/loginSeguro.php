<?php
// configuração do banco de dados
$servidor="localhost";
$usuario="root";
$senha="";
$banco="empresa_teste";

//Conexão usando MySqli sem proteção contra SQL injection
$conexao=new mysqli($servidor, $usuario, $senha, $banco);

//verifica se há erro na conexão
if($conexao->connect_error){
    die("Erro de conexão: " .$conexao->connect_error);
}

//captura os dados do formulário (nome de usuário)
$nome=$_POST["nome"];

//prepara a consulta SQL segura
$stmt=$conexao->prepare("SELECT * FROM cliente_teste WHERE nome=?");
$stmt->bind_param("s",$nome);
$stmt->execute();
$result=$stmt->get_result();

//executa a consulta sem proteção contra sql injection
//$sql="SELECT * FROM cliente_teste WHERE nome='$nome'";
//$result=$conexao->query($sql);

//se houver resultado, o login é considerado bem-sucedido
if($result->num_rows > 0){
    header("Location: area_restrita.php");
    //Garante que o código pare aqui para evitar execução indevida
    exit();
} else {
    echo "Nome não encontrado";
}
//fecha conexão
$stmt->close();
$conexao->close();
?>