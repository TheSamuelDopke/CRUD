<?php
session_start();

require 'conexao.php';

if (isset($_SESSION['mensagem_sucesso'])) {
    $mensagem = $_SESSION['mensagem_sucesso'];
    unset($_SESSION['mensagem_sucesso']);

?>
    <script>
        window.addEventListener('load', () => {
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
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <header>
        <h1>Blog do Samo</h1>
        <a href="criar_post.php"><button>Criar post</button></a>
    </header>

    <main>
        <h2>Posts:</h2>


            <?php
            $sql = 'SELECT * FROM posts';

            $posts = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($posts) > 0) {
                

            ?>

                    <?php
                    foreach ($posts as $post) {
                    ?>
                    <div class="div_posts">
                        <h2><?= $post['titulo'] ?></h1>
                        <h4>Autor: <?= $post['autor'] ?></h2>
                        <div>
                            <a href="ver_post.php?id=<?= $post['id'] ?>" class="link_ver_post"><button>Ver postagem</button></a>
                        </div>
                    </div>



                    <?php
                }
            } else {


                    ?>
                    <ul>
                        <li>Não há nenhum post!</li>
                    </ul>
                <?php
            }
                ?>


    </main>
</body>

</html>