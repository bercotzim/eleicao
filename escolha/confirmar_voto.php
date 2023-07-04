<?php

// Gerar o hash usando sha512sum
// $inputFile = "E:/voto-secreto.bin";
// $hashFile = "E:/voto-secreto.hash";
// $hash = hash_file('sha512', $inputFile);
// file_put_contents($hashFile, $hash);

// sha512sum E:/voto-secreto.bin > E:/voto-secreto.hash
// tentar usar isso de alguma forma



// -----------------------------------------

// $numeroEleitor = $_POST['numero_eleitor'];
// $senha = $_POST['senha'];

// $assinatura = "openssl dgst -sha512 -sign E:/{$numeroEleitor}_private.pem -out E:/voto-secreto.sign -passin pass:{$senha} E:/voto-secreto.hash";

// shell_exec($assinatura);


////////////////////////////////////////////////////////////////////

$numeroEleitor = $_POST['numero_eleitor'];
$senha = $_POST['senha'];

$assinatura = "openssl dgst -sha512 -sign E:/{$numeroEleitor}_private.pem -out E:/voto-secreto.sign -passin pass:{$senha} E:/voto-secreto.hash";

$output = array();
$returnCode = -1;
exec($assinatura, $output, $returnCode);

if ($returnCode === 0) {

    $resultado = "Voto assinado com sucesso!<br> Dirija-se ao mesário!";
    $cor = "green";
} else {
    $resultado = "Ocorreu um erro na assinatura.";
    $cor = "red";
}

?>


<style>
    body {
        margin: 0;
        height: 100vh;
        background-color: #f2f2f2;
    }

    .conteudo {
        display: flex;
        flex-direction: column-reverse;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    p {
        color: white;
        font-size: 30px;
        margin: 0;
        padding: 5px;
        border-radius: 5px;
        margin-top: 5px;
    }

    #contador {
        font-size: 48px;
        font-weight: bold;
        color: #333;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="conteudo">
        <p style="text-align: center; background: <?php echo $cor ?>"><?php echo $resultado ?></p>

        <?php
        echo "<div id='contador'></div>";

        ?>
    </div>

    <style>
        footer p {
            text-align: center;
            position: fixed;
            font-weight: 600;
            font-size: 15px;
            color: black;
            bottom: 0;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            width: 100%;
        }
    </style>

    <footer>
        <p style="margin: 15px 0;">Desenvolvido por: Matheus Berçot Pinheiro</p>
    </footer>
    <script>
        var contador = 9; // Tempo em segundos
        var contadorElemento = document.getElementById('contador');
        contadorElemento.innerText = 'Redirecionando em ' + contador + ' segundos';

        var interval = setInterval(function() {
            contador--;
            contadorElemento.innerText = 'Redirecionando em ' + contador + ' segundos';

            if (contador <= 0) {
                clearInterval(interval);
                window.location.href = 'escolha.html';
            }
        }, 1000); // Intervalo de 1 segundo
    </script>

</body>

</html>