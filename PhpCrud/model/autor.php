<?php

require_once(__DIR__."/../configs/conexao.php");

class Autor{

    public static function cadastrar($nome){
        try{
            $jaExiste= Autor::getAutorPorNOME($nome);//se nao houver um nome igual
            if(!$jaExiste){
                $con= Conexao::getConexao();
                $stmt= $con->prepare("INSERT INTO autor(nome) VALUES (?)");
                $stmt->execute([$nome]);
                if($stmt->rowCount()>0){
                    return true;
                }else{
                    return false;
                }
            }
            
        } catch(Exception $e){
            echo $e->getMessage();
            exit;
        }

    }

    public static function existe($id){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT COUNT(*) FROM autor WHERE id = ? ");
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
            $stmt= $con->prepare("SELECT * FROM autor");
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
            $con->beginTransaction();//comeca a operacao de mudanca em multiplos enderecos de banco

            $stmt= $con->prepare("DELETE FROM livro WHERE idAutor = ?");
            $stmt->execute([$id]);

            $stmt= $con->prepare("DELETE FROM autor WHERE id = ?");
            $stmt->execute([$id]);

            $con->commit();//finaliza a operacao

            if($stmt->rowCount()>0){
                return true;
            }else{
                return false;
            }

            
        }catch(Exception $e){
            $con->rollBack();
            echo $e->getMessage();
            exit;
        }
    }

    public static function editar($nome,$id){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("UPDATE autor SET nome=? WHERE id=?");
            $stmt->execute([$nome,$id]);

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

    public static function getAutorPorNOME($nome){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT * from autor WHERE nome=?");
            $stmt->execute([$nome]);

            if($stmt->rowCount()>0){
                return $stmt->fetchAll();
            }else{
                return false;
            }
            
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function getAutorPorID($id){
        try{
            $con= Conexao::getConexao();
            $stmt= $con->prepare("SELECT * from autor WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchAll();
        }catch(Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

}


/*
$teste = Autor::getAutor("Carl Sagan");

echo $teste[0]["id"];*/



