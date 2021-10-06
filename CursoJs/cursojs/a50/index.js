/**
 * parametros da funcao
 */
// //recebe parametros podendo aplicar valor padrao caso não seja enviado
// function funcao(a, b = 2, c = 4) {
//     //arguments é padrao da funcao e armazena o que for enviado
//     console.log(a + b + c);
// }
// //envia argumentos
// funcao(2, undefined, 1);
// //funcao(2, 0, 1); //assume o 0 para valor b
// //funcao(2, null, 1); //assume o null para valor b

// //desestruturacao obj
// function funcao2({ nome, sobrenome, idade }) {
//     console.log(nome, sobrenome, idade);
// }
// funcao2({ nome: 'ze', sobrenome: 'roela', idade: 30 });


// //desestruturacao array
// function funcao3([valor1, valor2, valor3]) {
//     console.log(valor1, valor2, valor3);
// }
// funcao3(['ze', 'roela', 30]);

//rest operator
//function expression
// const conta = function conta(operador, acumulador, ...numeros) {
//     //console.log(operador, acumulador, numeros);
//     for (let numero of numeros) {
//         if (operador === '+') acumulador += numero;
//         if (operador === '-') acumulador -= numero;
//         if (operador === '/') acumulador /= numero;
//         if (operador === '*') acumulador *= numero;
//     }
//     console.log(acumulador);
// };
// conta('+', 0, 20, 30, 40, 50);

//arow function
const conta = (operador, acumulador, ...numeros) => {
    for (let numero of numeros) {
        if (operador === '+') acumulador += numero;
        if (operador === '-') acumulador -= numero;
        if (operador === '/') acumulador /= numero;
        if (operador === '*') acumulador *= numero;
    }
    console.log(acumulador);
};
conta('+', 0, 20, 30, 40, 50);