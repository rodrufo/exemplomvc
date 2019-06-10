<h1>Página Inicial</h1>
<p>Seja bem-vindo.</p>
<?php if (estaLogado()): ?>
<p>Usuário logado: <?php echo $_SESSION['nome'] ?>.</p>
<p>Perfil: <?php echo $_SESSION['perfil'] ?>.</p>
<?php endif; ?>

