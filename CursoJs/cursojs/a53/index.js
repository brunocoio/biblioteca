/**
 * closure
 */

function retornaFuncao() {
    const nome = 'zé';
    return function() {
        return nome;
    }
}

const funcao = retornaFuncao('roela');
console.dir(funcao);
console.log(funcao());