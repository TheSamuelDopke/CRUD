<?php
session_start();

require 'conexao.php';

if (isset($_POST['btn_criar_post'])) {
    $titulo = mysqli_real_escape_string($conexao, trim($_POST['titulo']));

    $autor = mysqli_real_escape_string($conexao, trim($_POST['autor']));

    $corpo = mysqli_real_escape_string($conexao, trim($_POST['corpo']));


   

    if (empty($titulo) || empty($autor) || empty($corpo)) {
        $_SESSION['mensagem_erro'] = "ERRO: Preencha todos os campos!";
        header('Location: criar_post.php');

        exit;
    } else {
        $sql = "INSERT INTO posts (titulo, autor, corpo) VALUES ('$titulo', '$autor', '$corpo')";

        mysqli_query($conexao, $sql);
        $_SESSION['mensagem_sucesso'] = "Post criado com sucesso!";
        header('Location: index.php');
        exit;
    }
}


if (isset($_POST['update_usuario'])){
    $id = mysqli_real_escape_string($conexao, $_POST['edit_id']);

    $titulo = mysqli_real_escape_string($conexao, trim($_POST['edit_titulo']));

    $autor = mysqli_real_escape_string($conexao, trim($_POST['edit_autor']));

    $corpo = mysqli_real_escape_string($conexao, trim($_POST['edit_corpo']));

    if(empty($titulo) || empty($autor) || empty($corpo)){
        $_SESSION['mensagem_erro'] = "ERRO: Ocorreu um erro ao atualizar a postagem!";
        header('Location: ver_post.php?id='.$id);
        exit;
    }

    $sql = "UPDATE posts SET titulo = '$titulo', autor = '$autor', corpo = '$corpo' WHERE id = '$id'";

    mysqli_query($conexao, $sql);

    if(mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem_sucesso'] = 'Post atualizado com sucesso!';
        header('Location: ver_post.php?id='.$id);
        exit;
    }else{
        $_SESSION['mensagem_erro'] = "ERRO: Você não fez nenhuma alteração no post!";
        header('Location: ver_post.php?id='.$id);
        exit;
    }
}


if(isset($_POST['excluir_post'])){
    $id = mysqli_real_escape_string($conexao, $_POST['excluir_post']);

    $sql = "DELETE FROM posts WHERE id='$id'";
    mysqli_query($conexao, $sql);

    if(mysqli_affected_rows($conexao) > 0){
        $_SESSION['mensagem_sucesso'] = "Post deletado com sucesso!";
        header('Location: index.php');
        exit;
    }else{
        $_SESSION['mensagem_erro'] = "Post não foi deletado!";
        header('Location: index.php');
        exit;
    }
}
