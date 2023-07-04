<?php

$keyFile = 'keyTEscolhaTDeposito.bin';
$encryptedFile = 'E:/voto-secreto.bin';
$decryptedContent = shell_exec("openssl aes-256-cbc -d -kfile $keyFile -in $encryptedFile");
if ($decryptedContent !== null) {

    $voto = trim($decryptedContent);
} else {

    $voto = null;
}



?>


<!DOCTYPE html>
<html>
<head>
  <title>Validar Assinatura</title>
</head>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
    flex-direction: column;
  }

  form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ccc;
    text-align: center;
    border-radius: 4px;
  }

  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
  }

  input[type="submit"]:hover {
    background-color: #45a049;
  }

  span{
    color: blue;
    font-weight: 900;
  }

</style>
<body>
  <p>
    Precisa executar antes:
    sha512sum E:/voto-secreto.bin > validacao
  </p>
  <form action="validar_assinatura.php" method="post">
  <p>Seu voto: <span><?php echo $voto; ?></span></p>
  <input type="hidden" name="voto" value="<?php echo $voto; ?>">
  <input type="submit" value="Confirmar Voto">
</form>

</body>
</html>
