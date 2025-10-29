<?php
session_start();

require 'conexao.php';

if (isset($_SESSION['mensagem_sucesso'])) {
    $mensagem = $_SESSION['mensagem_sucesso'];
    unset($_SESSION['mensagem_sucesso']);

?>
    <script>
        window.addEventListener('load', () => {

            window.alert('<?php echo htmlspecialchars($mensagem); ?>')
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
        <ul>
            <table>
                                    <?php
                    $sql = 'SELECT * FROM posts';

                    $posts = mysqli_query($conexao, $sql);

                    if (mysqli_num_rows($posts) > 0) {
                        foreach ($posts as $post) {

                    ?>
                <thead>
                    <tr>
                        <th>Título</th>

                        <th>Autor</th>
                    </tr>
                </thead>
                <tbody>

                            <tr>
                                <td><?= $post['titulo'] ?></td>
                                <td><?= $post['autor'] ?></td>
                            </tr>



                    <?php
                        }
                    }else{

                   
                    ?>
                    <li>Não há nenhum post!</li>

                    <?php
 }
                    ?>
                </tbody>



            </table>
        </ul>
    </main>
</body>

</html>