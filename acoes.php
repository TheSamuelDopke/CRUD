<?php
session_start();

require 'conexao.php';

if (isset($_POST['btn_criar_post'])) {
    $titulo = mysqli_real_escape_string($conexao, $_POST['titulo']);

    $autor = mysqli_real_escape_string($conexao, $_POST['autor']);

    $corpo = mysqli_real_escape_string($conexao, $_POST['corpo']);

    if (empty($titulo) || empty($autor) || empty($corpo)) {
        $_SESSION['mensagem_erro'] = "ERRO: Preencha todos os campos!";
        header('Location: criar_post.php');

        exit;
    } else {
        $sql = "INSERT INTO posts (titulo, autor, corpo) VALUES ('$titulo', '$autor', '$corpo')";

        mysqli_query($conexao, $sql);
        $_SESSION['mensagem_sucesso'] = "Post Criado com Sucesso!";
        header('Location: index.php');
        exit;
    }
}
