<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Voto</title>
</head>

<body>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            height: 100vh;
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .verification-message {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        #contador {
            font-size: 48px;
            font-weight: bold;

            color: #333;
        }

        #valido {
            color: white;
            font-size: 30px;
            margin: 0;
            padding: 5px;
            border-radius: 5px;
            background-color: green;
            margin-top: 5px;
        }

        #invalido {
            color: white;
            font-size: 30px;
            margin: 0;
            padding: 5px;
            border-radius: 5px;
            margin-top: 5px;
            background-color: red;

        }
    </style>
    <?php
    $numeroEleitor = $_POST['numero_eleitor'];

    $comando = "openssl dgst -sha512 -verify {$numeroEleitor}_public.pem -signature E:/voto-secreto.sign E:/voto-secreto.hash";


    $resultado = shell_exec($comando);


    if ($resultado !== null && strpos($resultado, "Verified OK") !== false) {
        echo "<div id='contador'></div>";
        echo "<p id='valido'>Eleitor Válido</p>";
    ?>
        <script>
            var contador = 3; // Tempo em segundos
            var contadorElemento = document.getElementById('contador');
            contadorElemento.innerText = 'Redirecionando em ' + contador + ' segundos';

            var interval = setInterval(function() {
                contador--;
                contadorElemento.innerText = 'Redirecionando em ' + contador + ' segundos';

                if (contador <= 0) {
                    clearInterval(interval);
                    window.location.href = 'mesario_assinatura.html';
                }
            }, 1000); // Intervalo de 1 segundo
        </script>
    <?php
    } else {
        echo "<div id='contador'></div>";
        echo "<p id='invalido'>Esse voto não foi assinado pela mesma pessoa</p>";

    ?>
        <script>
            var contador = 3; // Tempo em segundos
            var contadorElemento = document.getElementById('contador');
            contadorElemento.innerText = 'Redirecionando em ' + contador + ' segundos';

            var interval = setInterval(function() {
                contador--;
                contadorElemento.innerText = 'Redirecionando em ' + contador + ' segundos';

                if (contador <= 0) {
                    clearInterval(interval);
                    window.location.href = 'mesario.html';
                }
            }, 1000); // Intervalo de 1 segundo
        </script>
    <?php }
    ?>


</body>

</html>