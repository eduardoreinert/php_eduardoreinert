<?php
    require_once "conexao.php";

    //estabelece a conexão
    $conexao=conectadb();

    //define a consulta SQL para buscar cliente
    $sql="SELECT id_cliente,nome,email FROM cliente";

    //executa a consulta no banco
    $result=$conexao->query($sql);

    //verifica se há registros retornados
    if($result->num_rows > 0){
        while($linha=$result->fetch_assoc()){
            echo "<br/>ID: ".$linha["id_cliente"]."- Nome: ".$linha["nome"]."- E-mail: ".$linha["email"]."</br>";
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }
    
    $conexao->close();
?>