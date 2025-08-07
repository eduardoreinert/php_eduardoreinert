<?php
    //funcao para redimensionar a imagem
    function redimensionarImagem($imagem,$largura,$altura){
        //obtem as dimensoes originais da imagem
        //getimagesize() retorna a largura e a altura de uma imagem
        list($larguraOriginal,$alturaOriginal) = getimagesize($imagem);

        //cria uma nova imagem em banco com as novas dimensoes
        //imagecreatetruecolor() cria uma nova imagem em branco em alta qualidade
        $novaImagem=imagecreatetruecolor($largura,$altura);

        //carrega a imagem original (jpeg) a partir do arquivo
        //imagecreatefromjpeg cria uma imagem php a partir de um jpeg
        $imagemOriginal=imagecreatefromjpeg($imagem);

        //copia e redimensiona a imagem original para a nova
        //imagecopyresampled() copia com redimensionamento e suavização
        imagecopyresampled($novaImagem,$imagemOriginal, 0, 0, 0, 0, $largura, $altura, $larguraOriginal, $alturaOriginal);

        //inicia um buffer para guardar a imagem com texto binario
        //ob_start() inicia o "output buffering" guardando a saida
        ob_start();

        //imagejpeg() envia a imagem para o output
        imagejpeg($novaImagem);

        //ob_get_clean pega o conteudodo buffer e limpa
        $dadosImagem=ob_get_clean();

        //libera a memoria usada pelas imagens
        //imagedestroy() limpa a memoria da imagem criada
        imagedestroy($novaImagem);
        imagedestroy($imagemOriginal);

        //retorna a imagem redimensionada em formato binario
        return $dadosImagem;
    }

    //configuração do banco de dados
    $host='localhost';
    $dbname='db_imagens';
    $username='root';
    $password='';

    try{
        //conexao com o banco de dados usando PDO
        $pdo=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //define que erros vao lançar exceções

        //verifica se foi um post e se tem arquivo 'foto'
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])){

            if($_FILES['foto']['error'] == 0){
                $nome=$_POST['nome']; //pega o nome do funcionario
                $telefone=$_POST['telefone']; //pega o telefone o funcionario
                $nomeFoto=$_FILES['foto']['name']; //pega o nome original do arquivo
                $tipoFoto=$_FILES['foto']['type']; //pega o tipo mime da imagem

                //redimensiona a imagem
                $foto=redimensionarImagem($_FILES['foto']['tmp_name'], 300, 400); //tmp_name é o caminho temporario

                //insere no bnco de dados usando sql preparado
                $sql="INSERT INTO funcionarios (nome,telefone,nome_foto,tipo_foto,foto) values (:nome,:telefone,:nome_foto,:tipo_foto,:foto)";
                
                $stmt=$pdo->prepare($sql); //prepara a query para evitar ataque sql injection
                $stmt->bindParam(':nome',$nome); //liga os parametros as variaveis
                $stmt->bindParam(':telefone',$telefone); //liga os parametros as variaveis
                $stmt->bindParam(':nome_foto',$nomeFoto); //liga os parametros as variaveis
                $stmt->bindParam(':tipo_foto',$tipoFoto); //liga os parametros as variaveis
                $stmt->bindParam(':foto',$foto, PDO::PARAM_LOB); //lob = large object usado para dados binarios com imagens

                if($stmt->execute()){
                    echo "Funcionário cadastrado com sucesso!";
                } else {
                    echo "Erro ao cadastrar o funcionário.";
                }
            } else {
                echo "Erro ao fazer o upload da foto! Código: ".$_FILES['foto']['error'];
            }
        }
    } catch(PDOException $e){
        echo "Erro: ".$e->getMessage(); //mostra o erro se houver
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de imagens</title>
</head>
<body>
    <h1>Lista de imagens</h1>

    <a href="consultaFuncionario.php">Listar Funcionários></a>
</body>
</html>