<?php
if (isset($_GET['mensagem'])) {
    switch ($_GET['mensagem']) {
        case 'cadastro':
            $mensagem = 'Cliente cadastrado com sucesso.';
            break;
        case 'atualizacao':
            $mensagem = 'Cliente atualizado com sucesso.';
            break;
        case 'excluido':
            $mensagem = 'Cliente foi excluido com sucesso.';
            break;
        case 'desconhecido':
            $mensagem = 'Não foi possível cadastrar o cliente. Por favor, tente novamente.';
            break;
    }
}
?>
<?php
include 'model/cliente.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST')
    $clientes = consultarCliente(null, $_POST);
else
    $clientes = consultarCliente();
?>

<h3>Clientes cadastros (<?php echo mysqli_num_rows($clientes) ?>)</h3>

<form method="POST" action="./?pagina=lista" id="consulta">
    <div>
        <label for="nome">Nome</label>
        <input type="text" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : '' ?>">
    </div>
    <?php
    $estadoCivil = array(
        'casado' => 'Casado',
        'divorciado' => 'Divorciado',
        'solteiro' => 'Solteiro',
        'uniaoestavel' => 'União Estável',
        'viuvo' => 'Viúvo',
        2 => 'Expulso de Casa',
    );
    ?>

    <div>
        <label for="estadocivil">Estado Civil</label>
        <select name="estadocivil">
            <option></option>

            <?php foreach ($estadoCivil as $posicao => $valor): ?>

                <?php if (isset($_POST['estadocivil']) && $_POST['estadocivil'] == $posicao): ?>
                    <option value="<?php echo $posicao ?>" selected><?php echo $valor ?></option>
                <?php else: ?>
                    <option value="<?php echo $posicao ?>"><?php echo $valor ?></option>
                <?php endif; ?>

            <?php endforeach; ?>

        </select>
    </div>
    <div>
        <input type="submit" value="Enviar">
    </div>
</form>
<br>

<?php if (isset($mensagem)): ?>
    <h4 class="erro"><?php echo $mensagem ?></h4>
<?php endif; ?>

<?php if (mysqli_num_rows($clientes) > 0): ?>
    <table cellspacing="0">
        <tr class="titulo">
            <th>Foto</th>
            <th>Nome</th>
            <th>Data de nascimento</th>
            <th>Estado civil</th>
            <?php if ($_SESSION['perfil'] == 'administrador'): ?>
                <th class="acoes">Ações</th>
            <?php endif; ?>
        </tr>
        <?php $linha = 1 ?>
        <?php while ($cliente = mysqli_fetch_assoc($clientes)): ?>

            <tr <?php echo $linha % 2 != 0 ? 'class="impar"' : '' ?>>
                <td>
                    <?php if ($cliente['foto']): ?>
                    <img src="upload/<?php echo $cliente['foto'] ?>" alt="Foto perfil">
                    <?php else: ?>
                    Foto não cadastrada.
                    <?php endif; ?>
                </td>
                <td><?php echo $cliente['nome'] ?></td>
                <td><?php echo mysqlToBr($cliente['nascimento']) ?></td>
                <td><?php echo $cliente['estadocivil'] ?></td>
                <?php if ($_SESSION['perfil'] == 'administrador'): ?>
                    <td class="acoes">
                        <a href="./?pagina=formcliente&idcliente=<?php echo $cliente['idcliente'] ?>">Editar</a>
                        <a href="controller/cliente.php?acao=excluir&idcliente=<?php echo $cliente['idcliente'] ?>">Excluir</a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php $linha++ ?>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <h1>Nenhum cliente foi cadastrado.</h1>
<?php endif; ?>