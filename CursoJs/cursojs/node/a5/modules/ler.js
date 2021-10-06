/**
 * capturando diretorio, arquivos e pastas
 */
const fs = require('fs').promises;

module.exports = (caminho) => fs.readFile(caminho, 'utf8');