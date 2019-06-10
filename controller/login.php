<?php

include '../model/cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $valido = validarLogin($_POST);

    if (is_array($valido)) {
        
        // login
        session_start();
        $_SESSION['idcliente'] = $valido['idcliente'];
        $_SESSION['nome'] = $valido['nome'];
        $_SESSION['email'] = $valido['email'];
        $_SESSION['perfil'] = $valido['perfil'];
        
        header('Location: ../');
        exit;
        
    } else {
        header('Location: ../index.php?pagina=login&erro=' . $valido);
        exit;
    }
} else {
    header('Location: ../index.php');
    exit;
}
?>