/**
 * gera arquivo json, exporta e importa
 */

const path = require('path');
const caminhoArquivo = path.resolve(__dirname, 'teste.json');

const escreve = require('./modules/escrever');
const ler = require('./modules/ler');

//gera arquivo json
const pessoas = [
    { nome: 'ze' },
    { nome: 'josney' },
];
const json = JSON.stringify(pessoas, '', 2);
escreve(caminhoArquivo, json);

//ler arquivo
async function leArquivo(caminho) {
    const dados = await ler(caminho);
    renderizaDados(dados);
}

function renderizaDados(dados) {
    dados = JSON.parse(dados);
    dados.forEach(val => console.log(val.nome));
}
leArquivo(caminhoArquivo);