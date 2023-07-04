<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verifica se os campos nome e numero foram enviados
    if (isset($_POST["nome"]) && isset($_POST["numero"])) {
        // Obtém os valores dos campos
        $nome = $_POST["nome"];
        $numero = $_POST["numero"];
        
        // Substitui espaços por underscores no nome
        $nome = str_replace(" ", "_", $nome);
        
        // Verifica se o arquivo JSON já existe
        if (file_exists("candidatos.json")) {
            // Obtém o conteúdo atual do arquivo JSON
            $jsonContent = file_get_contents("candidatos.json");
            
            // Decodifica o conteúdo JSON para um array associativo
            $dadosExistentes = json_decode($jsonContent, true);
        } else {
            // Se o arquivo não existe, cria um array vazio
            $dadosExistentes = array();
        }
        
        // Cria um novo objeto com os dados fornecidos
        $novoObjeto = array(
            "nome" => $nome,
            "numero" => $numero
        );
        
        // Adiciona o novo objeto ao array existente
        $dadosExistentes[] = $novoObjeto;
        
        // Converte o array em JSON
        $jsonNovo = json_encode($dadosExistentes);
        
        // Salva o JSON de volta no arquivo
        file_put_contents("candidatos.json", $jsonNovo);
        
        // Redireciona para a página candidato.html com a mensagem de sucesso
        header("Location: candidato.html?status=success");
        exit(); // Termina a execução do script
        
    } else {
        // Se os campos não foram enviados, retorna uma mensagem de erro
        echo "Campos 'nome' e 'numero' são obrigatórios!";
    }
}
?>
