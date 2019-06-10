<h3>Autenticação</h3>
<ul class="erro">
    <?php
    // index.php?pagina=formcliente&erro0=nome&erro1=nascimento&erro2=email&erro3=cpf&erro4=estadocivil&erro5=endereco&erro6=senha
    if (isset($_GET['erro'])) {
        switch ($_GET['erro']) {
            case 'obrigatorio':
                echo '<li>O e-mail e a senha devem ser preenchidos.</li>';
                break;
            case 'invalido':
                echo '<li>O e-mail e/ou senha informado(s) é(são) inválido(s).</li>';
                break;
        }
    }
    ?>
</ul>

<form method="post" action="controller/login.php">

    <label for="email">Email</label>
    <input type="text" name="email">

    <label for="senha">Senha</label>
    <input type="password" name="senha">

    <div id="button">
        <input type="submit" value="Entrar">
    </div>
</form>