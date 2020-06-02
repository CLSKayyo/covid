<?php
$weekago = time() - (7 * 24 * 60 * 60);
$url = 'https://covidapi.info/api/v1/country/BRA/timeseries/'.date('yy-m-d', $weekago).'/'.date('yy-m-d');
$response = json_decode(file_get_contents($url));


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="src/styles.css">


        <title>COVID-19 no Brasil</title>
    </head>
    <body>
        <h1 class="titulo">Até agora, no Brasil*</h1>
        <div class="row">
            <div class="dados">
                <h2><?=$response->result[6]->confirmed?></h2>
                <h3>confirmados</h3>
            </div>
            <div class="dados">
                <h2><?=$response->result[6]->deaths?></h2>
                <h3>mortos</h3>
            </div>
            <div class="dados">
                <h2><?=$response->result[6]->recovered?></h2>
                <h3>recuperados</h3>
            </div>
        </div>

        <p class="obs">*Dados atualizados do dia <?=date('d/m', time()-(1*24*60*60))?> através dos dados do repositório do <a href="https://github.com/CSSEGISandData/COVID-19">Centro de Ciência e Engenharia de Sistemas da Universidade Johns Hopkins.</a></p>

        <div class="container">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-md-10 graficocontainer">
                    <canvas id="lineChart" class="grafico"></canvas>
                </div>
            </div>
        </div>

        <p class="disclaimer">O Website tem como único intuito a informação, não tendo como objetivo causar medo ou qualquer
            tipo de preocupação por parte da população. Siga rigorosamente as medidas estabelecidas pelos órgãos governantes
            do país e não acredite em toda informação caso não existam fontes confiáveis comprovando a mesma.
            A maior forma de se proteger é se manter informado!
        </p>
        <p class="data">Website criado por <a href="../">Caio Lucas</a> utilizando a <a href="https://github.com/backtrackbaba/covid-api">API COVID</a>.</p>
        

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="src/js/mdb.js"></script>
        <script>
            var ctxL = document.getElementById("lineChart").getContext('2d');
            var gradientFill1 = ctxL.createLinearGradient(0, 0, 0, 290);
            gradientFill1.addColorStop(0, "rgba(173, 53, 186, 1)");
            gradientFill1.addColorStop(1, "rgba(173, 53, 186, 0.1)");
            var gradientFill2 = ctxL.createLinearGradient(0, 0, 0, 290);
            gradientFill2.addColorStop(0, "rgba(2, 166, 199, 1)");
            gradientFill2.addColorStop(1, "rgba(2, 166, 199, 0.1)");
            var gradientFill3 = ctxL.createLinearGradient(0, 0, 0, 290);
            gradientFill3.addColorStop(0, "rgba(62, 186, 53, 1)");
            gradientFill3.addColorStop(1, "rgba(62, 186, 53, 0.1)");
            var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: ["<?=date('d/m', time()-(7*24*60*60))?>", "<?=date('d/m', time()-(6*24*60*60))?>", "<?=date('d/m', time()-(5*24*60*60))?>", "<?=date('d/m', time()-(4*24*60*60))?>", "<?=date('d/m', time()-(3*24*60*60))?>", "<?=date('d/m', time()-(2*24*60*60))?>", "<?=date('d/m', time()-(1*24*60*60))?>"],
                datasets: [
                {
                    label: "Número de casos confirmados",
                    data: [
                        <?=$response->result[0]->confirmed?>,
                        <?=$response->result[1]->confirmed?>,
                        <?=$response->result[2]->confirmed?>,
                        <?=$response->result[3]->confirmed?>,
                        <?=$response->result[4]->confirmed?>,
                        <?=$response->result[5]->confirmed?>,
                        <?=$response->result[6]->confirmed?>,
                    ],
                    backgroundColor: gradientFill1,
                    borderColor: [
                    '#AD35BA',
                    ],
                    borderWidth: 2,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(173, 53, 186, 0.1)",
                },
                {
                    label: "Número de mortes",
                    data: [
                        <?=$response->result[0]->deaths?>,
                        <?=$response->result[1]->deaths?>,
                        <?=$response->result[2]->deaths?>,
                        <?=$response->result[3]->deaths?>,
                        <?=$response->result[4]->deaths?>,
                        <?=$response->result[5]->deaths?>,
                        <?=$response->result[6]->deaths?>,
                    ],
                    backgroundColor: gradientFill2,
                    borderColor: [
                    '#02a6c7',
                    ],
                    borderWidth: 2,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(173, 53, 186, 0.1)",
                },
                {
                    label: "Número de recuperações",
                    data: [
                        <?=$response->result[0]->recovered?>,
                        <?=$response->result[1]->recovered?>,
                        <?=$response->result[2]->recovered?>,
                        <?=$response->result[3]->recovered?>,
                        <?=$response->result[4]->recovered?>,
                        <?=$response->result[5]->recovered?>,
                        <?=$response->result[6]->recovered?>,
                    ],
                    backgroundColor: gradientFill3,
                    borderColor: [
                    '#3eba35',
                    ],
                    borderWidth: 2,
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "rgba(173, 53, 186, 0.1)",
                }
                ]
            },
            options: {
                responsive: true,
            }
            });
        </script>
    </body>
</html>