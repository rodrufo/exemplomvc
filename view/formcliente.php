<h3>Preencha por favor</h3>
<p>Todos os campos são de preenchimento obrigatório.</p>
<ul class="erro">
    <?php
    // index.php?pagina=formcliente&erro0=nome&erro1=nascimento&erro2=email&erro3=cpf&erro4=estadocivil&erro5=endereco&erro6=senha
    if (count($_GET) > 1) {
        // apagar elemento do array
        unset($_GET['pagina']);
        foreach ($_GET as $i => $campo) {
            if ($i != 'idcliente') {
                if ($campo == 'emailinvalido')
                    echo '<li>O e-mail informado é inválido.</li>';
                else if ($campo == 'senhainvalida')
                    echo '<li>A senha deve conter no mínimo 6 caracteres.</li>';
                else if ($campo == 'cpfinvalido')
                    echo '<li>O CPF informado é inválido.</li>';
                else if ($campo == 'foto')
                    echo '<li>A FOTO não foi escolhida.</li>';
                else if ($campo == 'fotoinvalida')
                    echo '<li>Envie um arquivo de imagem válido para suas FOTO.</li>';
                else if ($campo == 'upload')
                    echo '<li>Ocorreu um erro no upload da FOTO. Por favor, tente novamente.</li>';
                else
                    echo '<li>O campo ' . $campo . ' é obrigatório e deve ser preenchido.</li>';
            }
        }
    }
    ?>
</ul>

<?php
if (isset($_GET['idcliente']) && $idcliente = trim($_GET['idcliente'])) {
    include 'model/cliente.php';
    $cliente = consultarCliente($idcliente);
    $cliente = mysqli_fetch_assoc($cliente);
}
?>

<form method="post" enctype="multipart/form-data" action="controller/cliente.php<?php echo isset($cliente) ? '?idcliente=' . $idcliente : '' ?>">

    <label for="nome">Nome</label>
    <input type="text" name="nome" value="<?php echo isset($cliente) ? $cliente['nome'] : '' ?>">

    <label for="nascimento">Data de nascimento</label>
    <input type="date" name="nascimento" value="<?php echo isset($cliente) ? $cliente['nascimento'] : '' ?>">

    <label for="email">E-mail</label>
    <input type="text" name="email" value="<?php echo isset($cliente) ? $cliente['email'] : '' ?>">

    <label for="cpf">CPF</label>
    <input type="text" name="cpf" value="<?php echo isset($cliente) ? $cliente['cpf'] : '' ?>">

    <?php
// exemplo de vetor com elementos iniciais
    $estadoCivil = array(
        'casado' => 'Casado',
        'divorciado' => 'Divorciado',
        'solteiro' => 'Solteiro',
        'uniaoestavel' => 'União Estável',
        'viuvo' => 'Viúvo',
        2 => 'Expulso de Casa',
    );
    ?>

    <label for="estadocivil">Estado Civil</label>
    <select name="estadocivil">
        <option></option>

        <?php foreach ($estadoCivil as $posicao => $valor): ?>

            <?php if (isset($cliente) && $cliente['estadocivil'] == $posicao): ?>
                <option value="<?php echo $posicao ?>" selected><?php echo $valor ?></option>
            <?php else: ?>
                <option value="<?php echo $posicao ?>"><?php echo $valor ?></option>
            <?php endif; ?>

        <?php endforeach; ?>

    </select>

    <label for="endereco">Endereço</label>
    <input type="text" name="endereco" value="<?php echo isset($cliente) ? $cliente['endereco'] : '' ?>">

    <?php if (!isset($cliente)): ?>
        <label for="senha">Senha</label>
        <input type="password" name="senha">
    <?php endif; ?>

    <label for="foto">Foto</label>
    <input type="file" name="foto">

    <div id="button">
        <input type="submit" value="Enviar">
        <a href="index.php">Cancelar</a>
    </div>
</form>