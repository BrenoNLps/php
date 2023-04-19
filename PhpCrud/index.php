<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <?php
        require_once(__DIR__."/model/autor.php");
        require_once(__DIR__."/model/livro.php");

        if(isset($_POST["nome"]) and !empty($_POST["nome"])){
                $nome = $_POST["nome"];

                $resultado = Autor::cadastrar($nome);
                if($resultado) {
                    echo "<p>Cadastro do autor realizado com sucesso!</p>";
                } else {
                    echo "<p>Falha no cadastro</p>";
                }
        }

        if(isset($_POST["nome"]) and !empty($_POST["nome"]) and
            isset($_POST["genero"]) and !empty($_POST["genero"]) and
            isset($_POST["ano"]) and !empty($_POST["ano"]) and
            isset($_POST["idAutor"]) and !empty($_POST["idAutor"]) 
        ) {
            $nome = $_POST["nome"];
            $genero = $_POST["genero"];
            $ano = $_POST["ano"];
            $idAutor = $_POST["idAutor"];

            if(!Autor::existe($idAutor)) {
                echo "<p>livro não pode ser cadastrado!</p>";
            } else {
                $resultado = Livro::cadastrar($nome, $genero, $ano, $idAutor);
                if($resultado) {
                    echo "<p>Cadastro do livro realizado com sucesso!</p>";
                } else {
                    echo "<p>Falha no cadastro</p>";
                }
            }

            
            
        }
    ?>
    <!---->
    <div  class="div1" >
        <div>
            <h4>Cadastrar novo autor</h4><BR>
            <form method="POST">
                <p>Nome:</p>
                <input type="text" name="nome" placeholder="escreva o  nome" required>
                <br>
                <button>Cadastrar</button>
            </form>
        </div>

        <div>
        <h4>Cadastrar novo livro</h4><BR>
        <form method="POST">
            <p>Digite o nome</p>
            <input type="text" name="nome" value="" required >
            <p>Digite a genero</p>
            <input type="text" name="genero" required>
            <p>Digite o ano</p>
            <input type="number" name="ano" min="0" required>
            <p>Selecione o autor</p>
            <select name="idAutor" required>
                <option value=""></option>
                <?php
                    $listaAutores = Autor::listar();

                    foreach($listaAutores as $autor) {
                    echo "<option value=".$autor["id"].">".$autor["nome"]."</option>";
                    }
                ?>
            </select>
            <br>
            <button>Cadastrar</button>
        </form>

        </div>
    </div>

    <div  class="div2" >
        <h1>autores</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $listaAutor = Autor::listar();

                    foreach($listaAutor as $autor) {
                        echo "<tr>";
                        echo "<td>" . $autor["id"] . "</td>";
                        echo "<td>" . $autor["nome"] . "</td>";
                        echo "<td><a href='delAutor.php?id=".$autor["id"]."'>Deletar</a></td>";
                        echo "<td><a href='editAutor.php?id=".$autor["id"]."'>Editar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>

    <div  class="div3" >
        <h1>livros</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Gênero</th>
                    <th>Ano</th>
                    <th>Autor</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $listaLivros = Livro::listar();

                    foreach($listaLivros as $livro) {
                        echo "<tr>";
                        echo "<td>" . $livro["id"] . "</td>";
                        echo "<td>" . $livro["nome"] . "</td>";
                        echo "<td>" . $livro["genero"] . "</td>";
                        echo "<td>" . $livro["ano"] . "</td>";

                        $Autor = Autor::getAutorPorID($livro["idAutor"]);

                        echo "<td>" . $Autor[0]["nome"] . "</td>";
                        echo "<td><a href='delLivro.php?id=".$livro["id"]."'>Deletar</a></td>";
                        echo "<td><a href='editLivro.php?id=".$livro["id"]."'>Editar</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

    </div>

    <div class="4">
        <div>
        <form method="POST">
            <p>Procurar livro por ano:</p>
            <input type="number" name="ano" placeholder="2000" required>
            <button>Procurar por ano</button>

        </form> 
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Gênero</th>
                    <th>Ano</th>
                    <th>Autor</th>
                        
                </tr>
            </thead>
            <tbody>        

            
            <?php 
            
            if(isset($_POST["ano"]) and !empty($_POST["ano"])){
                $ano=$_POST["ano"];
                $livros=Livro::getAno($ano);
               
                foreach($livros as $livro) {
                    echo "<tr>";
                    echo "<td>" . $livro["id"] . "</td>";
                    echo "<td>" . $livro["nome"] . "</td>";
                    echo "<td>" . $livro["genero"] . "</td>";
                    echo "<td>" . $livro["ano"] . "</td>";

                    $Autor = Autor::getAutorPorID($livro["idAutor"]);

                    echo "<td>" . $Autor[0]["nome"] . "</td>";
                    echo "<td><a href='delLivro.php?id=".$livro["id"]."'>Deletar</a></td>";
                    echo "<td><a href='editLivro.php?id=".$livro["id"]."'>Editar</a></td>";
                    echo "</tr>";
                }
            }    
            ?>
            </tbody>
            </table>
         
        </div>              
    </div>

    <div class="5">
        <div>
        <form method="POST">
            <p>Procurar livro por nome do autor:</p>
            <input type="text" name="nome" placeholder="Carl Sagan" required>
            <button>Procurar por nome</button>

        </form> 
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Gênero</th>
                    <th>Ano</th>
                    <th>Autor</th>
                        
                </tr>
            </thead>
            <tbody>        

            
            <?php 
            
            if(isset($_POST["nome"]) and !empty($_POST["nome"])){
                $nome=$_POST["nome"];
                $autor=Autor::getAutorPorNOME($nome);
                $livros=Livro::getAutor($autor[0]["id"]);
               
                foreach($livros as $livro) {
                    echo "<tr>";
                    echo "<td>" . $livro["id"] . "</td>";
                    echo "<td>" . $livro["nome"] . "</td>";
                    echo "<td>" . $livro["genero"] . "</td>";
                    echo "<td>" . $livro["ano"] . "</td>";

                    $Autor = Autor::getAutorPorID($livro["idAutor"]);

                    echo "<td>" . $Autor[0]["nome"] . "</td>";
                    echo "<td><a href='delLivro.php?id=".$livro["id"]."'>Deletar</a></td>";
                    echo "<td><a href='editLivro.php?id=".$livro["id"]."'>Editar</a></td>";
                    echo "</tr>";
                }
            }    
            ?>
            </tbody>
            </table>
         
        </div>              
    </div>

    <div class="6">
        <div>
        <form method="POST">
            <p>Procurar livro por genero:</p>
            <input type="text" name="genero" placeholder="Policial" required>
            <button>Procurar por genero</button>

        </form> 
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Gênero</th>
                    <th>Ano</th>
                    <th>Autor</th>
                        
                </tr>
            </thead>
            <tbody>        

            
            <?php 
            
            if(isset($_POST["genero"]) and !empty($_POST["genero"])){
                $genero=$_POST["genero"];
                $livros=Livro::getGenero($genero);
               
                foreach($livros as $livro) {
                    echo "<tr>";
                    echo "<td>" . $livro["id"] . "</td>";
                    echo "<td>" . $livro["nome"] . "</td>";
                    echo "<td>" . $livro["genero"] . "</td>";
                    echo "<td>" . $livro["ano"] . "</td>";

                    $Autor = Autor::getAutorPorID($livro["idAutor"]);

                    echo "<td>" . $Autor[0]["nome"] . "</td>";
                    echo "<td><a href='delLivro.php?id=".$livro["id"]."'>Deletar</a></td>";
                    echo "<td><a href='editLivro.php?id=".$livro["id"]."'>Editar</a></td>";
                    echo "</tr>";
                }
            }    
            ?>
            </tbody>
            </table>
         
        </div>              
    </div>
</body>
</html>