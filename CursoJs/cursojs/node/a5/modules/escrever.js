/**
 * capturando diretorio, arquivos e pastas
 */

const fs = require('fs').promises;
// const path = require('path');
// const caminhoArquivo = path.resolve(__dirname, '..', 'teste.json');

// const pessoas = [
//     { nome: 'ze' },
//     { nome: 'josney' },
// ];
// const json = JSON.stringify(pessoas, '', 2);

module.exports = (caminho, dados) => {
    fs.writeFile(caminho, dados, { flag: 'w', encoding: 'utf8' });
};



// fs.writeFile(caminhoArquivo, 'frase 1\n', { flag: 'w', encoding: 'utf8' }); //w apaga td e escreve do zero, a add apos
// fs.writeFile(caminhoArquivo, 'frase 2\n', { flag: 'a' }); //a add apos