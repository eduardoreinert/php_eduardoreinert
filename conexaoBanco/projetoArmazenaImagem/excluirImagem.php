<?php
    require("conecta.php");

    //obtem o id da imagem da url garantindo que seja um numero inteiro
    $id_imagem=isset($_GET['id'])? intval($_GET['id']):0;

    // verifica se o id é valido (maior que zero)
    if($id_imagem > 0){
        // criar a query segura usando o prepare statement
        $queryExlusao="DELETE FROM imagens WHERE codigo=?";

        //prepara a query
        $stmt=$conexao->prepare($queryExlusao);
        $stmt->bind_param("i",$id_imagem); // define o id com um inteiro

        //executa a exclusao
        if($stmt->execute()){
            echo "Imagem excluída com sucesso!";
        } else {
            die("Erro ao excluir a imagem: ".$stmt->error);
        }

        // fecha a consulta
        $stmt->close();
    } else {
        echo "ID inválido";
    }

    // redireciona para a index.php e garante que o script pare
    header("Location:index.php");
    exit();
?>