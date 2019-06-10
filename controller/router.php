<?php

if (isset($_GET['pagina']) && $pagina = trim($_GET['pagina'])) {
    $filename = 'view/' . $pagina . '.php';

    if (file_exists($filename)) {

        if (estaLogado()) {

            switch ($pagina) {
                case 'formcliente':
                    $perfil = array('administrador');
                    break;
                case 'perfil':
                case 'senha':
                    $perfil = array('cliente');
                    break;
                default:
                    $perfil = array('administrador', 'cliente');
                    break;
            }

            if (in_array($_SESSION['perfil'], $perfil))
                include_once $filename;
            else
                include_once 'view/error403.php';
            
        } else if ($pagina == 'home' || $pagina == 'login')
            include_once $filename;
        else
            include_once 'view/error403.php';
        
    } else
        include 'view/error404.php';
    
} else {
    // include, include_once, require, require_once
    include 'view/home.php';
}
?>

