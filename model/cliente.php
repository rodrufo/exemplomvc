<?php

function validarLogin($cliente) {
    $email = isset($cliente['email']) && trim($cliente['email']) ? trim($cliente['email']) : null;
    $senha = isset($cliente['senha']) && trim($cliente['senha']) ? trim($cliente['senha']) : null;

    if ($email && $senha) {
        include '../model/conexao.php';
        $sql = "SELECT * FROM cliente WHERE "
                . "email = '" . addslashes($cliente['email']) . "' AND "
                . "senha = '" . md5($cliente['senha']) . "'";

        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) == 1)
            return mysqli_fetch_assoc($resultado);
        else
            return 'invalido';
    } else
        return 'obrigatorio';
}

function excluirCliente($idcliente) {
    include '../model/conexao.php';
    $sql = 'DELETE FROM cliente WHERE idcliente = ' . $idcliente;

    return mysqli_query($conexao, $sql);
}

function consultarCliente($idcliente = null, $consulta = null) {
    include 'model/conexao.php';
    $sql = 'SELECT * FROM cliente';

    if ($idcliente)
        $sql .= ' WHERE idcliente = ' . $idcliente;

    if ($consulta) {
        $nome = isset($consulta['nome']) ? trim($consulta['nome']) : null;
        $estadocivil = isset($consulta['estadocivil']) ? trim($consulta['estadocivil']) : null;

        if ($nome && !$estadocivil)
            $sql .= " WHERE nome LIKE '%$nome%'";
        else if ($estadocivil && !$nome)
            $sql .= " WHERE estadocivil = '$estadocivil'";
        else if ($estadocivil && $nome)
            $sql .= " WHERE nome LIKE '%$nome%' AND estadocivil = '$estadocivil'";
    }

    return mysqli_query($conexao, $sql);
}

function atualizarCliente($cliente, $idcliente) {
    include '../model/conexao.php';

    $sql = 'UPDATE cliente SET '
            . "nome='" . $cliente['nome'] . "',"
            . "nascimento='" . $cliente['nascimento'] . "',"
            . "email='" . $cliente['email'] . "',"
            . "cpf='" . $cliente['cpf'] . "',"
            . "estadocivil='" . $cliente['estadocivil'] . "',"
            . "foto='" . $cliente['foto'] . "',"
            . "endereco='" . $cliente['endereco'] . "'"
            . " WHERE idcliente = " . $idcliente;

    return mysqli_query($conexao, $sql);
}

function inserirCliente($cliente) {
    include '../model/conexao.php';

    $sql = 'INSERT INTO cliente (nome,nascimento,email,cpf,estadocivil,endereco,senha,foto) '
            . 'VALUES ('
            . "'" . $cliente['nome'] . "',"
            . "'" . $cliente['nascimento'] . "',"
            . "'" . $cliente['email'] . "',"
            . "'" . $cliente['cpf'] . "',"
            . "'" . $cliente['estadocivil'] . "',"
            . "'" . $cliente['endereco'] . "',"
            . "'" . md5($cliente['senha']) . "',"
            . "'" . $cliente['foto'] . "'"
            . ')';

    return mysqli_query($conexao, $sql);
}

function validarCliente($cliente, $idcliente = null) {
    $erros = array();
    
    $nome = isset($cliente['nome']) && trim($cliente['nome']) ? trim($cliente['nome']) : null;
    $nascimento = isset($cliente['nascimento']) && trim($cliente['nascimento']) ? trim($cliente['nascimento']) : null;
    $email = isset($cliente['email']) && trim($cliente['email']) ? trim($cliente['email']) : null;
    $cpf = isset($cliente['cpf']) && trim($cliente['cpf']) ? trim($cliente['cpf']) : null;
    $estadocivil = isset($cliente['estadocivil']) && trim($cliente['estadocivil']) ? trim($cliente['estadocivil']) : null;
    $endereco = isset($cliente['endereco']) && trim($cliente['endereco']) ? trim($cliente['endereco']) : null;
    $senha = isset($cliente['senha']) && trim($cliente['senha']) ? trim($cliente['senha']) : null;

    if (!$nome)
        $erros[] = 'nome';
    if (!$nascimento)
        $erros[] = 'nascimento';

    if (!$email)
        $erros[] = 'email';
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            $erros[] = 'emailinvalido';
    }

    if (!$cpf)
        $erros[] = 'cpf';
    else {
        if (!validaCPF($cpf))
            $erros[] = 'cpfinvalido';
    }

    if (!$estadocivil)
        $erros[] = 'estadocivil';
    if (!$endereco)
        $erros[] = 'endereco';

    if (!$idcliente) {
        if (!$senha)
            $erros[] = 'senha';
        else {
            if (strlen($senha) < 6)
                $erros[] = 'senhainvalida';
        }
    }
    
    print_r($_FILES['foto']);
    exit;
    
    if (isset($_FILES['foto']) && count($_FILES['foto']) > 0) {
        if (substr($_FILES['foto']['type'], 0, 5) != 'image')
            $erros[] = 'fotoinvalida';
        else {
            // construir novo nome único para gravar na pasta e no banco de dados
            $vetorNome = explode('.', $_FILES['foto']['name']);
            $novoNome = $vetorNome[0] . date('YmdHis') . '.' . $vetorNome[count($vetorNome)-1];
            $destination = '/var/www/html/ltpw3/mvc/upload/' . $novoNome;
            //
            $moveu = move_uploaded_file($_FILES['foto']['tmp_name'], $destination);
            if (!$moveu)
                $erros[] = 'upload';
        }
    } else {
        $erros[] = 'foto';
    }

    return array(
        'erros' => $erros,
        'cliente' => array(
            'nome' => $nome,
            'nascimento' => $nascimento,
            'email' => $email,
            'cpf' => $cpf,
            'estadocivil' => $estadocivil,
            'endereco' => $endereco,
            'senha' => $senha,
            'foto' => $novoNome,
        )
    );
}

function validaCPF($cpf = null) {

    // Verifica se um número foi informado
    if (empty($cpf)) {
        return false;
    }

    // Elimina possivel mascara
    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados é igual a 11 
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequências invalidas abaixo 
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
            $cpf == '11111111111' ||
            $cpf == '22222222222' ||
            $cpf == '33333333333' ||
            $cpf == '44444444444' ||
            $cpf == '55555555555' ||
            $cpf == '66666666666' ||
            $cpf == '77777777777' ||
            $cpf == '88888888888' ||
            $cpf == '99999999999') {
        return false;
        // Calcula os digitos verificadores para verificar se o
        // CPF é válido
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}

?>
