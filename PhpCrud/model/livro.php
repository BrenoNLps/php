<?php

use PSpell\Config;

require_once(__DIR__."/../configs/conexao.php");

class Livro{

    public static function cadastrar($nome,$genero,$ano,$idAutor){
        try{
            $jaExiste= Livro::getReplica($idAutor,$nome);
            if(!$jaExiste){
                $con = Conexao::getConexao();
            $stmt= $con->prepare("INSERT INTO livro(nome,genero,ano,idAutor) VALUES (?,?,?,?)");
            $stmt->execute([$nome,$genero,$ano,$idAutor]);

            if($stmt->rowCount()>0){
                return true;
            }else{
                return false;
            }
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public static function existe($id){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT COUNT(*) FROM livro WHERE id = ? ");
            $stmt->execute([$id]);

            if($stmt->fetchColumn()>0){
                return true;//se encontrar algum item retornara 1(verdadeiro)
            }else{
                return false;//...senão, retornará 0(falso)
            }
        }
        catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    } 

    public static function listar(){
        try{
             $con= Conexao::getConexao();
             $stmt= $con->prepare("SELECT * FROM livro");
             $stmt->execute();
 
             return $stmt->fetchAll();//retorna lista com os dados do select 
        }catch(Exception $e){
             echo $e->getMessage();
             exit;
        }
     }

     public static function deletar($id){
        try{
            $con= Conexao::getConexao();
        
            $stmt= $con->prepare("DELETE FROM livro WHERE id = ?");
            $stmt->execute([$id]);

            if($stmt->rowCount()>0){
                return true;
            }else{
                return false;
            }

            
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function deletarPorAutor($idAutor){
        try{
            $con= Conexao::getConexao();
        
            $stmt= $con->prepare("DELETE FROM livro WHERE idAutor = ?");
            $stmt->execute([$idAutor]);

            if($stmt->rowCount()>0){
                return true;
            }else{
                return false;
            }

            
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function editar($nome,$genero,$ano,$idAutor,$id){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("UPDATE livro SET nome=?,genero=?,ano=?,idAutor=? WHERE id=?");
            $stmt->execute([$nome,$genero,$ano,$idAutor,$id]);

            if($stmt->rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function getLivro($id) {
        try {
            $con = Conexao::getConexao();
            $stmt = $con->prepare("SELECT * FROM livro WHERE id = ?");
            $stmt->execute([$id]);

            return $stmt->fetchAll()[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function getAno($ano){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT * from livro WHERE ano=?");
            $stmt->execute([$ano]);

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

   

    public static function getGenero($genero){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT * from livro WHERE genero=?");
            $stmt->execute([$genero]);

            return $stmt->fetchAll();
            

        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function getAutor($idAutor){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT * from livro WHERE idAutor=?");
            $stmt->execute([$idAutor]);

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function getReplica($idAutor,$nome){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT * from livro WHERE idAutor=? AND nome=?");
            $stmt->execute([$idAutor,$nome]);

            if($stmt->fetchAll()){
                return true;
            }else{
                return false;
            }
            
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }
    

}


/*Procura por ano. O usuário poderá digitar um ano desejado e o sistema retornará a lista de livros que foram lançados naquele ano específico.

- Procura por autor. O usuário poderá digitar ou selecionar um autor. O sistema retorna a lista de livros que tal autor publicou.

- Procura por gênero. O usuário poderá digitar um gênero desejado e o sistema retornará a lista de livros que foram lançados com aquele gênero específico. */





