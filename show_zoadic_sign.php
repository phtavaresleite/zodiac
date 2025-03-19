<?php include('layouts/header.php') ?>

<body>
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="text-center col-8">
            <?php
            $signos = simplexml_load_file('signos.xml');
            $dataNascimento = $_POST["data"]; // Recebe a data no formato "2003-01-29"

            // Converte a data de nascimento para o formato DateTime
            $dataNasc = DateTime::createFromFormat('Y-m-d', $dataNascimento);

            if ($dataNasc) {
                // Extrai o dia e o mês da data de nascimento
                $diaNasc = (int)$dataNasc->format("d"); // Dia como int
                $mesNasc = (int)$dataNasc->format("m"); // Mês como int

                foreach ($signos->signo as $signo) {
                    // Converte as datas do signo para dia e mês (int)
                    list($diaInicio, $mesInicio) = explode('/', (string)$signo->dataInicio);
                    list($diaFim, $mesFim) = explode('/', (string)$signo->dataFim);

                    $diaInicio = (int)$diaInicio;
                    $mesInicio = (int)$mesInicio;
                    $diaFim = (int)$diaFim;
                    $mesFim = (int)$mesFim;

                    // Verifica se o signo cruza o ano (ex: Capricórnio, de 22/12 a 20/01)
                    if ($mesInicio > $mesFim) {
                        // Signo que cruza o ano (ex: Capricórnio)
                        if (
                            ($mesNasc == $mesInicio && $diaNasc >= $diaInicio) || // Após o início no mês inicial
                            ($mesNasc == $mesFim && $diaNasc <= $diaFim) ||       // Antes do fim no mês final
                            ($mesNasc > $mesInicio || $mesNasc < $mesFim)        // Entre os meses
                        ) {
                            echo "<p id='signo' ><strong> $signo->signoNome </strong></p> <br>";
                            echo "" . $signo->descricao;
                            break; // Sai do loop após encontrar o signo
                        }
                    } else {
                        // Signo normal (não cruza o ano)
                        if (
                            ($mesNasc == $mesInicio && $diaNasc >= $diaInicio) || // Após o início no mês inicial
                            ($mesNasc == $mesFim && $diaNasc <= $diaFim) ||       // Antes do fim no mês final
                            ($mesNasc > $mesInicio && $mesNasc < $mesFim)         // Entre os meses
                        ) {
                            echo "<h1 class='signo' ><strong> $signo->signoNome </strong></h1> <br>";
                            echo "<p class='signo descricao'> $signo->descricao </p>";
                            break; // Sai do loop após encontrar o signo
                        }
                    }
                }
            } else {
                echo "Erro: Data de nascimento inválida ou formato incorreto. <br>";
            }

            echo "<a href='index.php'><button class='btn btn-outline-light'>Voltar a pagina anterior</button></a>"
            ?>
        </div>
    </div>
</body>