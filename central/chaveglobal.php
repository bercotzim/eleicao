<?php 


$genGlobal = "openssl genpkey -genparam -algorithm DH -out chave-global.pem";
shell_exec($genGlobal);
?>