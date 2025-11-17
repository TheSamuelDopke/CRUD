<?php

//Define a conexão com o banco de dados:
define('HOST', '');
define('USUARIO', '');
define('SENHA', '');
define('DB', '');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não foi possivel conectar ao banco de dados!')

?>