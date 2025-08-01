<?php
    //definição das credenciais de acesso ao banco de dados
    $nomeservidor="localhost";
    $usuario="root";
    $senha="";
    $bancodedados="empresa";

    // criação da conexão com mysqli
    $conn=mysqli_connect($nomeservidor,$usuario,$senha,$bancodedados);

    //verificação da conexao
    if(!$conn){
        //caso a conexao falhe, interrompe o script e exibe uma mensagem de erro
        die("Conexão falhou: ".mysqli_connect_error());
    }

    //configuração do conjunto de caracteres para evitar problemas de acentuação
    mysqli_set_charset($conn,"utf8mb4");

    //mensagem indicando que a conexão foi estabelecida corretamente
    echo "Conexão bem-sucedida!";

    //consulta SQL para obter clientes
    $sql="SELECT id_cliente,nome,email FROM cliente";
    $result=mysqli_query($conn,$sql);

    //verifica se há resultados na consulta
    if(mysqli_num_rows($result) > 0){
        // itera sobre os resultados e exibe os dados
        while($linha=mysqli_fetch_assoc($result)){
            echo "<br/>ID: ".$linha["id_cliente"]."- Nome: ".$linha["nome"]."- E-mail: ".$linha["email"]."</br>";
        }
    } else {
        echo "Nenhum resultado encontrado.";
    }

    //fecha a conexão com o banco de dados
    mysqli_close($conn);
?>