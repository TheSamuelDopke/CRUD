<?php
session_start();
if(isset($_SESSION['mensagem_erro'])){
    $mensagem = $_SESSION['mensagem_erro'];

    unset($_SESSION['mensagem_erro']);
?>

<script >

window.addEventListener('load', () =>{ 


setTimeout(() =>{
window.alert('<?php echo htmlspecialchars($mensagem); ?>')

}, 10)

})
</script>

<?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog do Samo</title>
    <link rel="stylesheet" href="css/general.css">

    <link rel="stylesheet" href="css/criar_post.css">

    <style>

    </style>
</head>
<body>
    <header>
        <h1>Criação de Post:</h1>
        
        <a href="index.php"><button>Home</button></a>
        
    </header>


    <main>
        <form action="acoes.php" method="POST">
            <label for="titulo">Título do Post:</label>
            <input type="text" name="titulo" required>

            <label for="autor">Nome do Autor:</label>
            <input type="text" name="autor" required>

            <label for="corpo">Conteúdo do Post:</label>
            <textarea name="corpo" id="corpo" rows="20" required></textarea>

            <button type="submit" name="btn_criar_post">Enviar Post</button>
        </form>
    </main>
</body>
</html>