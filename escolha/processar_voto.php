<?php
$dado = $_POST['numero_candidato'];


// Salvar o número do candidato em um arquivo temporário
file_put_contents('temp.txt', $dado);

// Comando para criptografar usando openssl rsautl e ler o número do candidato a partir do arquivo temporário
$criptografar = 'openssl aes-256-cbc -e -kfile keyTEscolhaTDeposito.bin -in temp.txt -out E:/voto-secreto.bin';

// Executar o comando de criptografia
shell_exec($criptografar);

// Remover o arquivo temporário
unlink('temp.txt');

header('Location: confirmarvoto.html');
exit();