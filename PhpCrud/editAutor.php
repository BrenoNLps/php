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
        require_once(__DIR__."/model/autor.php");
        $idAutor = $_GET["id"];
        $autor = Autor::getAutorPorID($idAutor)[0];



        if(isset($_POST["nome"]) and !empty($_POST["nome"]) and
            isset($_POST["id"]) and !empty($_POST["id"]) 
        ) {
            $nome = $_POST["nome"];
            $id = $_POST["id"];

            if(!Autor::existe($id)) {
                echo "<h1>O Autor especificado não existe!</h1>";
                exit;
            } else {
                $resultado = Autor::editar($nome,$id);
                if($resultado) {
                    echo "<p>autor editado com sucesso!</p>";
                } else {
                    echo "<p>Falha na edição</p>";
                }
            }      
        
        }
    ?>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" value="<?= $autor["nome"] ?>" required>
        
            <input type="hidden" name="id" value="<?= $autor["id"] ?>">      
            <br>
            <button>Editar</button>
            <br>
            <a href='index.php'>Voltar página inicial</a>
    </form>
</body>
</html>