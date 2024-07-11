<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$alunos = array();

function menu() {
    echo "\nMenu:\n";
    echo "1. Cadastrar Alunos\n";
    echo "2. Atribuir Notas\n";
    echo "3. Exibir Resultados\n";
    echo "4. Editar Resultados\n";
    echo "5. Sair\n";
    echo "Escolha uma opção: ";
    $opcao = trim(fgets(STDIN));
    return $opcao;
}

function cadastrarAlunos(&$alunos) {
    for ($i = 0; $i < 5; $i++) {
        echo "Informe o nome do aluno " . ($i + 1) . ": ";
        $nome = trim(fgets(STDIN));
        $alunos[$i] = array("nome" => $nome, "notas" => array(), "media" => 0, "total" => 0, "resultado" => "");
    }
}

function atribuirNotas(&$alunos) {
    foreach ($alunos as $index => &$aluno) {
        echo "Atribuindo notas para " . $aluno['nome'] . ":\n";
        for ($j = 0; $j < 4; $j++) {
            do {
                echo "Informe a nota " . ($j + 1) . " (entre 0 e 10): ";
                $nota = (float) trim(fgets(STDIN));
            } while ($nota < 0 || $nota > 10);
            $aluno['notas'][$j] = $nota;
        }
        $aluno['total'] = array_sum($aluno['notas']);
        $aluno['media'] = $aluno['total'] / 4;
        if ($aluno['media'] < 4) {
            $aluno['resultado'] = "Reprovado";
        } elseif ($aluno['media'] <= 6) {
            $aluno['resultado'] = "Recuperação";
        } else {
            $aluno['resultado'] = "Aprovado";
        }
    }
}

function exibirResultados($alunos) {
    foreach ($alunos as $aluno) {
        echo "\nAluno: " . $aluno['nome'] . "\n";
        echo "Notas: " . implode(", ", $aluno['notas']) . "\n";
        echo "Total: " . $aluno['total'] . "\n";
        echo "Média: " . $aluno['media'] . "\n";
        echo "Resultado: " . $aluno['resultado'] . "\n";
    }
}

function editarResultados(&$alunos) {
    echo "Informe o nome do aluno que deseja editar: ";
    $nome = trim(fgets(STDIN));
    foreach ($alunos as &$aluno) {
        if ($aluno['nome'] == $nome) {
            echo "Aluno encontrado. Editando notas para " . $aluno['nome'] . ":\n";
            for ($j = 0; $j < 4; $j++) {
                do {
                    echo "Informe a nova nota " . ($j + 1) . " (entre 0 e 10): ";
                    $nota = (float) trim(fgets(STDIN));
                } while ($nota < 0 || $nota > 10);
                $aluno['notas'][$j] = $nota;
            }
            $aluno['total'] = array_sum($aluno['notas']);
            $aluno['media'] = $aluno['total'] / 4;
            if ($aluno['media'] < 4) {
                $aluno['resultado'] = "Reprovado";
            } elseif ($aluno['media'] <= 6) {
                $aluno['resultado'] = "Recuperação";
            } else {
                $aluno['resultado'] = "Aprovado";
            }
            echo "Notas atualizadas com sucesso.\n";
            return;
        }
    }
    echo "Aluno não encontrado.\n";
}

do {
    $opcao = menu();
    switch ($opcao) {
        case 1:
            cadastrarAlunos($alunos);
            break;
        case 2:
            atribuirNotas($alunos);
            break;
        case 3:
            exibirResultados($alunos);
            break;
        case 4:
            editarResultados($alunos);
            break;
        case 5:
            echo "Saindo...\n";
            break;
        default:
            echo "Opção inválida. Tente novamente.\n";
            break;
    }
} while ($opcao != 5);
?>


     
    
    
</body>
</html>