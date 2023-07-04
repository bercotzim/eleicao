<?php
while (true) {
    $binFile = 'E:/voto-secreto.bin';
    $hashFile = 'E:/voto-secreto.hash';

    if (file_exists($binFile) && !file_exists($hashFile)) {
        shell_exec("sha512sum $binFile > $hashFile");
        var_dump("Executado");
    }

    sleep(1);
}
