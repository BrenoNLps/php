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
        require_once(__DIR__."/model/livro.php");
        require_once(__DIR__."/model/autor.php");
        $idLivro = $_GET["id"];
        $livro= livro::getLivro($idLivro);
        
        if(isset($_POST["nome"]) and !empty($_POST["nome"]) and
            isset($_POST["genero"]) and !empty($_POST["genero"]) and
            isset($_POST["ano"]) and !empty($_POST["ano"]) and
            isset($_POST["idAutor"]) and !empty($_POST["idAutor"]) and
            isset($_POST["id"]) and !empty($_POST["id"]) 
        ) {
            $nome = $_POST["nome"];
            $genero = $_POST["genero"];
            $ano = $_POST["ano"];
            $idAutor = $_POST["idAutor"];
            $id = $_POST["id"];

            if(!Livro::existe($id)) {
                echo "<h1>O livro especificado não existe!</h1>";
                exit;
            }

            if(!Autor::existe($idAutor)) {
                echo "<p>livro não pode ser editado!</p>";
            } else {
                $resultado = livro::editar($nome, $genero, $ano, $idAutor,$id);
                if($resultado) {
                    echo "<p>livro editado com sucesso!</p>";
                } else {
                    echo "<p>Falha na edição</p>";
                }
            }       
        
        }



    ?>

<form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" value="<?= $livro["nome"] ?>" required>
        <p>Digite a genero</p>
        <input type="text" name="genero" value="<?= $livro["genero"] ?>" required>
        <p>Digite o ano</p>
        <input type="number" name="ano" value="<?= $livro["ano"] ?>" min="0" required>
        <p>Digite o dono</p>
            <select name="idAutor" required>
                <option value=""></option>
                <?php
                    $listaAutores = Autor::listar();

                    foreach($listaAutores as $autor) {
                        $id = $autor["id"];
                        $nome = $autor["nome"];

                        if($id == $livro["idAutor"]) {
                            echo "<option value='$id' selected>$nome</option>"; 
                        } else {
                            echo "<option value='$id'>$nome</option>";
                        }                        
                    }
                ?>
            </select> 
            <input type="hidden" name="id" value="<?= $livro["id"] ?>">      
            <br>
            <button>Editar</button>
            <br>
            <a href='index.php'>Voltar página inicial</a>
    </form>
</body>
</html>