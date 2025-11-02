<?php
session_start();

if (isset($_SESSION['mensagem_erro'])) {
    $mensagem = $_SESSION['mensagem_erro'];

    unset($_SESSION['mensagem_erro']);
?>

    <script>
        window.addEventListener('load', () => {

            setTimeout(() => {
                window.alert('<?php echo htmlspecialchars($mensagem); ?>')
            }, 10)


        })
    </script>

<?php
} elseif (isset($_SESSION['mensagem_sucesso'])) {
    $mensagem = $_SESSION['mensagem_sucesso'];

    unset($_SESSION['mensagem_sucesso']);



?>
    <script>
        window.addEventListener('load', () => {

            setTimeout(() => {
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
    <link rel="stylesheet" href="css/ver_post.css">
</head>

<body>
    <header>
        <h1>Blog do Samo</h1>
        <a href="index.php"><button>Home</button></a>
    </header>


    <main>



        <?php



        require 'conexao.php';

        if (isset($_GET['id'])) {
            $post_id = mysqli_real_escape_string($conexao, $_GET['id']);

            $sql = "SELECT * FROM posts WHERE id='$post_id'";
            $query = mysqli_query($conexao, $sql);

            if (mysqli_num_rows($query) > 0) {
                $post = mysqli_fetch_array($query);

                $corpo = $post['corpo'];

                $corpo_formatado = nl2br($corpo)


        ?>


                <div class="div_posts" id="div_post_view">
                    <h2><?= $post['titulo'] ?></h2>
                    <h4>Autor: <?= $post['autor'] ?>
                    </h4>
                    <div class="post_corpo">
                        <p><?= $corpo_formatado ?></p>
                    </div>
                    <button id="btn_edit">Editar</button>
                    <form action="acoes.php" method="POST" style="display: inline;" class="form_excluir">
                        <button class="btn_excluir" type="submit" name="excluir_post" value="<?= $post['id'] ?>" >Excluir</button>
                    </form>
                </div>


                <form action="acoes.php" method="POST" style="display: none;" id="form_post_edit">
                    <div class="div_posts">

                        <h2>Editar Post:</h2>
                        <input type="hidden" name="edit_id" value="<?= $post['id'] ?>">

                        <label for="edit_titulo">Titulo: </label>
                        <input name="edit_titulo" value="<?= $post['titulo'] ?>" required></input>

                        <label for="edit_autor">Autor: </label>
                        <input name="edit_autor" value="<?= $post['autor'] ?>" required>
                        </input>

                        <label for="edit_corpo">Texto do Post:</label>
                        <textarea rows="20" name="edit_corpo" class="post_corpo" required><?= $post['corpo'] ?></textarea>
                    </div>
                    <div>
                        <button type="submit" id="btn_save_edit" name="update_usuario">Salvar Alterações</button>
                        <button id="btn_cancel_edit">Cancelar</button>
                    </div>
                </form>



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


        <script>
            var btnEdit = document.querySelector('#btn_edit')
            var divPostView = document.querySelector('#div_post_view')
            var formPostEdit = document.querySelector('#form_post_edit')
            var btnCancelEdit = document.querySelector('#btn_cancel_edit')
            var btnSaveEdit = document.querySelector('#btn_save_edit')


            var btnExcluir = document.querySelector('.btn_excluir')

            var formExcluir = document.querySelector('.form_excluir')

            btnExcluir.addEventListener('click', (e) =>{
                
                const excluiu = confirm("Tem certeza que deseja excluir o post?")

                if(excluiu == false){
                    e.preventDefault()
                }

            })

            btnEdit.addEventListener('click', () => {
                divPostView.style.display = 'none'
                formPostEdit.style.display = 'block'
            })

            btnCancelEdit.addEventListener('click', (e) => {
                e.preventDefault()
                divPostView.style.display = 'block'
                formPostEdit.style.display = 'none'
            })
        </script>
    </main>
</body>

</html>