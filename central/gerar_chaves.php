<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroEleitor = $_POST['numero_eleitor'];
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $datanascimento = $_POST['data_nascimento'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    $dado = "Numero de Eleitor: " . $numeroEleitor . "; Cpf: " . $cpf . "; Nome: " . $nome . "; Endereço: " . $endereco . "; Data de Nascimento: " . $datanascimento;


    // Verificar se o número do eleitor, senha e confirmação de senha foram fornecidos
    if (empty($numeroEleitor) || empty($senha) || empty($confirmarSenha)) {
        echo "Por favor, preencha todos os campos.";
    } elseif ($senha !== $confirmarSenha) {
        echo "As senhas não coincidem. Por favor, tente novamente.";
    } else {
        
        $privateKeyPassphrase = $senha;
        $privateKeyPath = "/home/TSE/{$numeroEleitor}_private.pem";
        $publicKeyPath = "{$numeroEleitor}_public.pem";

        // Gerar Chave Privada
        $genPrivateKeyCommand = "openssl genrsa -aes256 -passout pass:\"" . $privateKeyPassphrase . "\" -out " . $privateKeyPath . " 4096";
        shell_exec($genPrivateKeyCommand);

        // Gerar Chave Pública
        $genPublicKeyCommand = "openssl rsa -in " .$privateKeyPath. " -pubout -passin pass:\"" .$privateKeyPassphrase. "\" -out " .$publicKeyPath. "";
        shell_exec($genPublicKeyCommand);


        $criptografar = 'echo "' . $dado . '" | openssl rsautl -encrypt -inkey ' . $publicKeyPath . ' -pubin > E:/cartao.txt.enc';

        shell_exec($criptografar);

        //echo "Chave privada gerada em: {$privateKeyPath}<br>";
        // echo "Chave pública gerada em: {$publicKeyPath}<br>";
    }
}
?>

<style>
    body{
        margin:0;
    }
    footer p {
        text-align: center;
        position: fixed;
        font-weight: 600;
        font-size: 15px;
        bottom: 0;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        width: 100%;
    }
</style>

<footer>
    <p>Desenvolvido por: Matheus Berçot Pinheiro</p>
</footer>