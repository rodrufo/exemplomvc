<?php

include '../model/cliente.php';

if (isset($_GET['acao']) && trim($_GET['acao']) == 'excluir') {
    if (isset($_GET['idcliente']) && $idcliente = trim($_GET['idcliente'])) {
        $excluiu = excluirCliente($idcliente);

        if ($excluiu) {
            header('Location: ../?pagina=lista&mensagem=excluido');
            exit;
        } else {
            header('Location: ../?pagina=error500');
            exit;
        }
    } else {
        header('Location: ../');
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idcliente = isset($_GET['idcliente']) ? trim($_GET['idcliente']) : null;

    // a função retorna um vetor de erros
    // vetor retornado é adicionado à variável $valido
    $validacao = validarCliente($_POST, $idcliente);

    // se o vetor estiver vazio, os dados está válidos
    if (count($validacao['erros']) == 0) {
        // gravar no banco de dados
        if ($idcliente)
            $gravou = atualizarCliente($validacao['cliente'], $idcliente);
        else
            $gravou = inserirCliente($validacao['cliente']);

        if ($gravou) {
            header('Location: ../index.php?pagina=lista&mensagem=' . (isset($idcliente) ? 'atualizacao' : 'cadastro'));
            exit;
        } else {
            header('Location: ../index.php?pagina=lista&mensagem=desconhecido');
            exit;
        }
    } else {
        // recarregar a view do formulário mostrando os erros
        // index.php?pagina=formcliente&erro0=nome&erro1=nascimento&erro2=email&erro3=cpf&erro4=estadocivil&erro5=endereco&erro6=senha
        $parametrosErro = '';
        foreach ($validacao['erros'] as $i => $campo) {
            $parametrosErro .= '&erro' . $i . '=' . $campo;
        }

        if ($idcliente)
            $parametrosErro .= '&idcliente=' . $idcliente;

        header('Location: ../index.php?pagina=formcliente' . $parametrosErro);
        exit;
    }
} else {
    header('Location: ../index.php');
    exit;
}
?>