/**
 * escopo léxico
 * funcao procura variável dentro dela, caso não encontre irá procurar em 'cascata' a variável
 */
const nome = 'zé';

function falaNome() {
    console.log(nome);
}

function usaFalaNome() {
    falaNome();
}

usaFalaNome();