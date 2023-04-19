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
        $idAutor = $_GET["id"];
        require_once(__DIR__."/model/autor.php");
        require_once(__DIR__."/model/livro.php");

        if( isset($_GET["id"]) and !empty($_GET["id"]) ){
            if(!autor::existe($idAutor)){
                echo "<h1>Este autor não existe</h1>";
                exit;
            }
            $exclusao =autor::deletar($idAutor);
            Livro::deletarPorAutor($idAutor);//deleta todos os livros do autor
            if($exclusao){
                echo"<h1>autor deletado com sucesso</h1>";
            }else{
                echo"<h1>Erro ao deletar autor</h1>";
            }
            echo "<a href='index.php'>Voltar página inicial</a>";
        }else{
            echo"<h1>autor não especificado</h1>";
            exit;
        }

    ?>
</body>
</html>