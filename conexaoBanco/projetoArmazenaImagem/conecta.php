<?php
    $endereco="localhost";
    $usuario="root";
    $senha="";
    $bancoDados="armazena_imagem";

    $conexao = new mysqli($endereco,$usuario,$senha,$bancoDados);

    if($conexao->connect_error){
        die("Falha na conexão: ".$conexao->connect_error);
    }
?>