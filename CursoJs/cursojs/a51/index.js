/**
 * retorno de funcoes
 */

// function criaPessoa(nome, sobrenome) {
//     return {
//         //nome: nome, //o js compreende quando exste chave com o mesmo argumento (mesmo nome), não é necessário a identificação de ambos
//         nome,
//         sobrenome,
//     };
// };

// const p1 = criaPessoa('zé', 'roela');
// const p2 = {
//     nome: 'josney',
//     sobrenome: 'roela',
// }
// console.log(typeof p1, typeof p2);
// console.log(p1, p2);

// //funcao dentro de funcao
// function falaFrase(comeco) {
//     function falaResto(resto) {
//         return comeco + ' ' + resto;
//     }
//     return falaResto;
// }
// // //a const se torna uma funcao com o retorno da primeira funcao ja om valor
// // const olaMundo = falaFrase('Olá');
// // //como a primeira funcao foi ativada e ja tem valor, ativou a segunda, que agora terá outro valor
// // console.log(olaMundo('mundo'));
// // //ou seja, funcao em cadeia, uma ativou a outra, a segunda se tornou uma funcao com um valor atribuido

// const fala = falaFrase('Olá');
// const resto = fala('mundo');
// console.log(resto);

/** funcao multiplicador */
function criaMultiplicador(multiplicador) {
    //multiplicador
    return function(n) {
        //valor a ser multiplicado
        return n * multiplicador;
    }
}
//aplica valor do multiplicador
const duplica = criaMultiplicador(2);
const triplica = criaMultiplicador(3);
const quadriplica = criaMultiplicador(4);
//aplica valor a ser multiplicado
console.log(duplica(2), triplica(2), quadriplica(2));
/** !funcao multiplicador */