<?php
while (true) {
    shell_exec("sha512sum E:/voto-secreto.bin > validacao");
    var_dump("Executado");
    sleep(5); // Pausa por 10 segundos
}
?>
