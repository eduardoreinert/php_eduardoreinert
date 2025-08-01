<?php
    //inclui o arquivo de conexão com o banco de dados
    require_once "conexao.php";

    $conexao=conectadb();

    $nome="Eduardo";
    $endereco="Rua imaginaria 3";
    $telefone="4799944551";
    $email="eduardo@gmail.com";

    //prepara a consulta SQL usando 'prepare()' para evitar SQL injection
    $stmt=$conexao->prepare("INSERT INTO cliente (nome,endereco,telefone,email) VALUES (?,?,?,?)");

    //associa os parametros aos valores da consulta
    $stmt->bind_param("ssss",$nome,$endereco,$telefone,$email);

    //executa a inserção
    if($stmt->execute()){
        echo "Cliente adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar cliente: ".$stmt->error;
    }

    //fecha a consulta e a conexão com o banco de dados
    $stmt->close();
    $conexao->close();
?>