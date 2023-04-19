<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $idLivro = $_GET["id"];
        require_once(__DIR__."/model/livro.php");

        if( isset($_GET["id"]) and !empty($_GET["id"]) ){
            if(!livro::existe($idLivro)){
                echo "<h1>Este livro não existe</h1>";
                exit;
            }
            $exclusao = livro::deletar($idLivro);
            if($exclusao){
                echo"<h1>Livro deletado com sucesso</h1>";
            }else{
                echo"<h1>Erro ao deletar livro</h1>";
            }
            echo "<a href='index.php'>Voltar página inicial</a>";
        }else{
            echo"<h1>Livro não especificado</h1>";
            exit;
        }

    ?>
</body>
</html>