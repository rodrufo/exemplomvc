<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/estilo.css" type="text/css" media="all" rel="stylesheet">
        <link href="css/print.css" type="text/css" media="print" rel="stylesheet">
        <title>Projeto Exemplo MVC - Home</title>
        <script>
            var dadosCliente = <?php echo $data ?>;
        </script>
        <script type="text/javascript" src="js/js.js"></script>
    </head>
    <body>
        <section id="container">
            <a href="index.php" id="logo">
                <h3>LOGO</h3>
            </a>
            <ul id="menu">
                <?php
                include 'model/uteis.php';
                ?>
                <?php if (estaLogado()): ?>
                    <?php if ($_SESSION['perfil'] == 'administrador'): ?>
                        <li><a href="index.php?pagina=formcliente">Formulário de Cliente</a></li>
                        <li> | <a href="index.php?pagina=lista">Clientes Cadastrados</a></li>
                        <li> | <a href="index.php?pagina=formcliente">Novo Cliente</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION['perfil'] == 'cliente'): ?>
                        <li><a href="index.php?pagina=lista">Clientes Cadastrados</a></li>
                        <li> | <a href="index.php?pagina=perfil">Perfil</a></li>
                        <li> | <a href="index.php?pagina=senha">Alterar Senha</a></li>
                    <?php endif; ?>
                    <li> |
                        <a href="controller/logout.php">
                            Sair (<?php echo $_SESSION['email'] ?>)
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="index.php?pagina=login">
                            Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <section id="content">
                <?php include 'controller/router.php'; ?>
            </section>
            <footer>
                <p>Este é o rodapé &copy; 2019</p>
            </footer>
        </section>
    </body>
</html>
