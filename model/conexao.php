<?php

$conexao = mysqli_connect('localhost', 'teste', 'teste', 'crud');

mysqli_set_charset($conexao, 'utf-8');

if (!$conexao) {
    header('Location: ../index.php?pagina=error500');
    exit;
}

?>