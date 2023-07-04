<?php
$output = shell_exec('echo test');
if ($output === 'test') {
    echo 'O ambiente PHP tem permissão para executar comandos do sistema.';
} else {
    echo 'O ambiente PHP não tem permissão para executar comandos do sistema.';
}
?>
