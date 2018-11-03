<?php

function boas_vindas() {
    $hora_atual = date(
        "H",
        strtotime("now")
    );

    if ($hora_atual >= 1 && $hora_atual < 6) {
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
 * Desenha uma linha no calendário
 *
 * @param array $semana Sete dias
 * @return void
 */
function linha($semana) {
    echo "<tr>";
    
    for ($i=0; $i <= 6; $i++) { 
        if (isset($i)) {
            echo "<td>{$semana[$i]}</td>";
        } else {
            echo "<td></td>";
        }
    }

    echo "</tr>";
}


function mes() {
    $dia = 1;
    $semana = array();

    while ($dia <= 31) {
        array_push($semana, $dia);

        if (count($semana) == 7) {
            linha($semana);

            $semana = array();
        }

        $dia++;
    }

    linha($semana);
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
    <br>
    <div class="row">
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
</body>
</html>

