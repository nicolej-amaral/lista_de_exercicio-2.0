<?php

$consultas = [
    ["Sarah", "Obstreticia", "11/11/2026", "8:00"],
    ["Nicole", "Cirurgia", "22/03/2026", "11:00"],
    ["Maicon", "Cardiologia", "27/08/2026", "18:00"],
    ["Luzia", "Pediatria", "19/12/2026", "20:00"],
    ["Noah", "Urologista", "25/02/2026", "09:30"]
];


function totalConsultas($consultas){
    return count($consultas);
}


function pacientesDiferentes($consultas){

    $pacientes = [];

    foreach($consultas as $consulta){

        if(!in_array($consulta[0], $pacientes)){
            $pacientes[] = $consulta[0];
        }

    }

    return count($pacientes);
}


function contarEspecialidades($consultas){

    $especialidades = [];

    foreach($consultas as $consulta){

        $especialidade = $consulta[1];

        if(isset($especialidades[$especialidade])){
            $especialidades[$especialidade]++;
        }else{
            $especialidades[$especialidade] = 1;
        }

    }

    return $especialidades;
}

function ordenarHorarios($consultas){

    for($i = 0; $i < count($consultas)-1; $i++){

        for($j = $i+1; $j < count($consultas); $j++){

            if($consultas[$i][3] > $consultas[$j][3]){

                $temp = $consultas[$i];
                $consultas[$i] = $consultas[$j];
                $consultas[$j] = $temp;

            }

        }

    }

    return $consultas;
}


function primeiroAtendimento($consultas){

    $ordenadas = ordenarHorarios($consultas);

    return $ordenadas[0];

}


function ultimoAtendimento($consultas){

    $ordenadas = ordenarHorarios($consultas);

    return $ordenadas[count($ordenadas)-1];

}

function pesquisarPaciente($consultas, $nome){

    $resultado = [];

    foreach($consultas as $consulta){

        if($consulta[0] == $nome){
            $resultado[] = $consulta;
        }

    }

    return $resultado;
}


function horariosDuplicados($consultas){

    $duplicados = [];

    for($i = 0; $i < count($consultas)-1; $i++){

        for($j = $i+1; $j < count($consultas); $j++){

            if($consultas[$i][3] == $consultas[$j][3]){
                $duplicados[] = $consultas[$i][3];
            }

        }

    }

    return $duplicados;
}

function organizarAgenda($consultas){

    $resultado = [];

    $resultado["Total de consultas"] = totalConsultas($consultas);
    $resultado["Pacientes diferentes"] = pacientesDiferentes($consultas);
    $resultado["Consultas por especialidade"] = contarEspecialidades($consultas);
    $resultado["Primeiro atendimento"] = primeiroAtendimento($consultas);
    $resultado["Último atendimento"] = ultimoAtendimento($consultas);
    $resultado["Lista ordenada"] = ordenarHorarios($consultas);
    $resultado["Pesquisa do paciente"] = pesquisarPaciente($consultas, "Juana");
    $resultado["Horários duplicados"] = horariosDuplicados($consultas);

    return $resultado;
}


$resultado = organizarAgenda($consultas);

echo "<b>Total de consultas:</b> " . $resultado["Total de consultas"] . "<br>";

echo "<b>Pacientes diferentes:</b> " . $resultado["Pacientes diferentes"] . "<br><br>";

echo "<b>Consultas por especialidade:</b><br>";

foreach($resultado["Consultas por especialidade"] as $especialidade => $quantidade){
    echo "- $especialidade: $quantidade consulta(s)<br>";
}

echo "<br>";

echo "<b>Primeiro atendimento:</b> " . $resultado["Primeiro atendimento"][0] . "<br>";

echo "<b>Último atendimento:</b> " . $resultado["Último atendimento"][0] . "<br><br>";

echo "<b>Lista ordenada:</b><br>";

foreach($resultado["Lista ordenada"] as $consulta){

    echo $consulta[3] . " - ";
    echo $consulta[0] . " - ";
    echo $consulta[1] . "<br>";

}

echo "<br>";

echo "<b>Pesquisa do paciente:</b><br>";

if(count($resultado["Pesquisa do paciente"]) > 0){

    foreach($resultado["Pesquisa do paciente"] as $consulta){

        echo $consulta[0] . " - ";
        echo $consulta[1] . " - ";
        echo $consulta[2] . " - ";
        echo $consulta[3] . "<br>";

    }

}else{

    echo "Paciente não encontrado.<br>";

}

echo "<br>";

echo "<b>Horários duplicados:</b><br>";

if(count($resultado["Horários duplicados"]) > 0){

    foreach($resultado["Horários duplicados"] as $horario){
        echo $horario . "<br>";
    }

}else{

    echo "Não existem horários duplicados.";

}

?>