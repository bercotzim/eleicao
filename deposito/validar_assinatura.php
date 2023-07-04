<?php

//TEM QUE SER EXECUTADO ANTES Q É A VALIDAÇÃO DO VOTO

//$validacao = "sha512sum E:/voto-secreto.bin > validacao";
//shell_exec($validacao);


//sha512sum E:/voto-secreto.bin > validacao

$comando = "openssl dgst -sha512 -verify 11111_public.pem -signature E:/voto-secreto.sign validacao";

//$comando ="openssl dgst -sha512 -verify 11111_public.pem -signature E:/voto-secreto.sign E:/voto-secreto.hash";

$resultado = shell_exec($comando);



if ($resultado !== null && strpos($resultado, "Verified OK") !== false) {
    $voto = $_POST['voto'];
    setlocale(LC_ALL, 'pt_BR'); // Define a localidade para o Brasil

    $horarioAtual = date('H:i:s'); // Obtém o horário atual no formato "hora:minuto:segundo"
    $dataAtual = date('d/m/Y'); // Obtém a data atual no formato "dia/mês/ano"

    $data = $horarioAtual . " - " . $dataAtual;

    // Caminho para o arquivo "voto-secreto.hash"
    $arquivo = 'E:/voto-secreto.hash';

    // Lê o conteúdo do arquivo
    $texto = file_get_contents($arquivo);

    // Caminho para o arquivo JSON
    $arquivo = 'votos.json';

    // Verifica se o arquivo existe
    if (file_exists($arquivo)) {
        // Lê o conteúdo do arquivo JSON
        $jsonContent = file_get_contents($arquivo);
        // Decodifica o JSON para um array PHP
        $votos = json_decode($jsonContent, true);
    } else {
        // Se o arquivo não existir, cria um novo array vazio
        $votos = [];
    }

    // Novo voto a ser adicionado
    $novoVoto = [
        'voto' => $voto,
        'data' => $data,
        'id' => $texto
    ];

    // Adiciona o novo voto ao array de votos
    $votos[] = $novoVoto;

    // Codifica o array em uma string JSON
    $jsonData = json_encode($votos);

    // Escreve a string JSON no arquivo
    file_put_contents($arquivo, $jsonData);


    $mensagem = "Voto confirmado";
    $estilo = "color: green;";
} else {
    $mensagem = "Esse voto não foi assinado pela mesma pessoa";
    $estilo = "color: red;";
}



?>
<!DOCTYPE html>
<html>

<head>
    <title>Resultado do Voto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            height: 100vh;
            display: flex;
            align-items: center;

        }

        .container {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .resultado {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Essa página fechará em <span id="contador">10</span> segundos</p>
        <h2>Resultado do Voto</h2>
        <div class="resultado">
            <p style="<?php echo $estilo ?>"> <?php echo $mensagem; ?> </p>
        </div>
    </div>

    <script>
        var tempoInicial = 9;
        var contadorElemento = document.getElementById("contador");

        function atualizarContador() {
            contadorElemento.textContent = tempoInicial;

            if (tempoInicial <= 0) {
                window.location.href = "deposito.php";
            } else {
                tempoInicial--;
                setTimeout(atualizarContador, 1000);
            }
        }

        setTimeout(atualizarContador, 1000);
    </script>
</body>


</html>