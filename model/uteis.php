<?php

session_start();

function estaLogado() {
    if (
            isset($_SESSION['idcliente']) && trim(isset($_SESSION['idcliente'])) &&
            isset($_SESSION['nome']) && trim(isset($_SESSION['nome'])) &&
            isset($_SESSION['email']) && trim(isset($_SESSION['email'])) &&
            isset($_SESSION['perfil']) && trim(isset($_SESSION['perfil']))
    )
        return true;
    else
        return false;
}

function mysqlToBr($data) {
    return substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4);
}
