<?php

/**
 * Ano a que o calendário exibirá
 */
define('ANO_CALENDARIO', date("Y",strtotime("now")));

/**
 * Dá as boas vindas ao usuário de acordo
 * com o horário da cunsulta.
 *
 * @return void
 */
function boas_vindas() {
    $hora_atual = date(
        "H",
        strtotime("now")
    );

    if ($hora_atual >= 0 && $hora_atual < 6) {
        echo "Boa madrugada";
    } else if ($hora_atual >= 6 && $hora_atual < 12) {
        echo "Bom dia";
    } elseif ($hora_atual >= 12 && $hora_atual < 19) {
        echo "Boa tarde";
    } else if ($hora_atual >= 19 && $hora_atual <= 23) {
        echo "Boa noite";
    }
}

/**
 * Renderiza um dia da semana
 *
 * @param string $tipo Tipo de dia ('normal', 'domingo', 'destaque', 'vazio')
 * @return void
 */
function renderDia($numero, $tipo="normal") {
    switch ($tipo) {
        case "normal":
            echo '<div class="day px-3 p-2">' . $numero . '</div>';
            break;
        case "domingo":
            echo '<div class="day px-3 p-2 text-danger">' . $numero . '</div>';
            break;
        case "destaque":
            echo '<div class="day px-3 rounded bg-info font-weight-bold p-2">'.$numero.'</div>';
            break;
        case "vazio":
            echo '<div class="day px-3 p-2 text-white">0</div>';
            break;
    }
}

/**
 * Desenha uma semana no mês
 *
 * @param array $semana Números que preencherão a semana
 * @param int|false $posicaoDestaque Determina a posição que ficará marcada como 'hoje' (0 - 6)
 * @return void
 */
function renderSemana($semana, $mesAtual=false) {
    echo '<div class="d-flex row justify-content-around px-4 week flex-nowrap">';

    for ($posicao_dia = 0; $posicao_dia < 7; $posicao_dia++) {
       
        /**
         * Caso seja o dia atual, faça um destaque
         */
        $destacarDia = $mesAtual && 
                       $semana[$posicao_dia] == date("j", strtotime("now"));

        
        if ($semana[$posicao_dia] == 0) {
            renderDia($semana[$posicao_dia], 'vazio');
        } else if ($destacarDia) {
            renderDia($semana[$posicao_dia], 'destaque');
        } else if ($posicao_dia == 6) {
            renderDia($semana[$posicao_dia], 'domingo');
        } else {
            renderDia($semana[$posicao_dia], 'normal');
        }
    }

    echo '</div>';
}


/**
 * Renderiza um mês espeficificado
 *
 * @param int Número do mês a ser renderizado
 * @return void
 */
function renderMes($mes) {
    $dia = 1;
    $semana = array();

    $meses_do_ano = [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    ];


    $nome_do_mes = $meses_do_ano[$mes - 1];

    // Cabeçalho do mês
    echo '
    
    <div class="col-md-6 col-lg-4 mb-3">
    <div class="card">
        <div class="card-header text-center font-weight-bold">
            ' . $nome_do_mes . '
        </div>
        <div class="card-body px-0">
            <div class="mx-auto">
                <div class="d-flex row justify-content-around px-4 font-weight-bold flex-nowrap">
                    <div>Dom</div>
                    <div>Seg</div>
                    <div>Ter</div>
                    <div>Qua</div>
                    <div>Qui</div>
                    <div>Sex</div>
                    <div>Sáb</div>
                </div>
                <hr>
                <div class="month-days">
    ';
    

        
    $qtdDiasNoMes = cal_days_in_month(CAL_JULIAN, $mes, ANO_CALENDARIO);

    $semana = array();
    
    $datasMes = new DateTime();
    $datasMes->setDate(ANO_CALENDARIO, $mes, 1);

    $posicaoPrimeiroDiaDoMes = date(
        "w",
        $datasMes->modify("first day of this month")->getTimestamp()
    );

    $posicaoUltimoDiaDoMes = date(
        "w",
        $datasMes->modify("last day of this month")->getTimestamp()
    );

    $mesAtual = (
        $mes . "/" . ANO_CALENDARIO ==
        date(
            "m/Y",
            $datasMes->modify("now")->getTimestamp()
        )
    );

    for ($diaNumero = 1; $diaNumero <= 35; $diaNumero++) {

        // Preenche os espaços vazios da semana com zeros
        $diaEmBranco = $diaNumero > $qtdDiasNoMes || 
                        $diaNumero < $posicaoPrimeiroDiaDoMes;
        
        if (!$diaEmBranco) {
            array_push($semana, $diaNumero);
        } else {
            array_push($semana, 0);
        }

        if (count($semana) == 7) {

            if ($mesAtual) {
                renderSemana($semana, true);
            } else {
                renderSemana($semana);
            }

            $semana = array();
        }
    }

    echo "
    </div>
                </div>
            </div>
        </div>
    </div>
    ";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container mx-auto mt-3">
    <h1 class="text-center"><?php boas_vindas(); ?>!</h1>
    <h3 class="text-center text-secondary font-weight-bold">Calendário de <?php echo ANO_CALENDARIO; ?></h3>
    <br>
    <div class="row">
        <?php
            for ($mesDoAno=1; $mesDoAno <= 12; $mesDoAno++) { 
                renderMes($mesDoAno);
            }
        ?>
    <!-- <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Março
            </div>
            <div class="card-body px-0">
                <div class="mx-auto">
                    <div class="d-flex row justify-content-around px-4 font-weight-bold flex-nowrap">
                        <div>Dom</div>
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sáb</div>
                    </div>
                    <hr>
                    <div class="month-days">
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Março
            </div>
            <div class="card-body px-0">
                <div class="mx-auto">
                    <div class="d-flex row justify-content-around px-4 font-weight-bold flex-nowrap">
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sáb</div>
                        <div>Dom</div>
                    </div>
                    <hr>
                    <div class="month-days">
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Março
            </div>
            <div class="card-body px-0">
                <div class="mx-auto">
                    <div class="d-flex row justify-content-around px-4 font-weight-bold flex-nowrap">
                        <div>Seg</div>
                        <div>Ter</div>
                        <div>Qua</div>
                        <div>Qui</div>
                        <div>Sex</div>
                        <div>Sáb</div>
                        <div>Dom</div>
                    </div>
                    <hr>
                    <div class="month-days">
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                        <div class="d-flex row justify-content-around px-4 week flex-nowrap">
                            <div class="day px-3 rounded bg-info p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                            <div class="day px-3 p-2">8</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</body>
</html>

