<?php
if (isset($_POST['executar'])) {
    $genPriv = "openssl genpkey -paramfile pendriveSecao/chave-global.pem -out privTDeposito.pem";
    shell_exec($genPriv);

    $genPublic = "openssl pkey -in privTDeposito.pem -pubout -out pendriveSecao/publicTDeposito.pem";
    shell_exec($genPublic);
    echo "Comando executado com sucesso!";
}
?>
