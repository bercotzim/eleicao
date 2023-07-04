const fs = require('fs');

// Verifica se o arquivo existe
if (fs.existsSync('votos.json')) {
  // Lê o conteúdo do arquivo e converte para um objeto JavaScript
  const votosFileContent = fs.readFileSync('votos.json', 'utf8');
  var votos = JSON.parse(votosFileContent);
} else {
  // Se o arquivo não existir, cria um novo objeto vazio
  var votos = {};
}

const voto = 5
const data = 3

// Novo voto a ser adicionado
const novoVoto = {
  voto: voto,
  data: data
};

// Gera um identificador único para o novo voto (por exemplo, usando timestamp)
const novoVotoId = "voto_" + Date.now();

// Adiciona o novo voto ao objeto 'votos'
votos[novoVotoId] = novoVoto;

// Converte o objeto 'votos' em uma string JSON
const jsonData = JSON.stringify(votos);

// Escreve a string JSON no arquivo 'votos.json'
fs.writeFileSync('votos.json', jsonData);

console.log("Voto adicionado com sucesso!");
