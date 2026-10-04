<?php

function contarMaiusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_upper($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarMinusculas($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_lower($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarNumeros($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (ctype_digit($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function contarEspeciais($senha) {
    $quantidade = 0;

    for ($i = 0; $i < strlen($senha); $i++) {
        if (!ctype_alnum($senha[$i])) {
            $quantidade++;
        }
    }

    return $quantidade;
}

function classificarSenha($senha) {
    $pontuacao = 0;

    if (strlen($senha) >= 8) {
        $pontuacao++;
    }

    if (contarMaiusculas($senha) > 0) {
        $pontuacao++;
    }

    if (contarMinusculas($senha) > 0) {
        $pontuacao++;
    }

    if (contarNumeros($senha) > 0) {
        $pontuacao++;
    }

    if (contarEspeciais($senha) > 0) {
        $pontuacao++;
    }

    if ($pontuacao <= 2) {
        return "Fraca";
    } elseif ($pontuacao == 3) {
        return "Média";
    } elseif ($pontuacao == 4) {
        return "Forte";
    } else {
        return "Muito Forte";
    }
}

function analisarSenha($senha) {
    return [
        "Maiúsculas" => contarMaiusculas($senha),
        "Minúsculas" => contarMinusculas($senha),
        "Números" => contarNumeros($senha),
        "Especiais" => contarEspeciais($senha),
        "Tamanho" => strlen($senha),
        "Segurança" => classificarSenha($senha)
    ];
}

$senha = "Teste@123";

print_r(analisarSenha($senha));

?>