/**
 * reduce
 */

const numeros = [5, 50, 80, 1, 2, 3, 5, 8, 7, 11, 15, 22, 27];
//soma de todos os valores
// const total = numeros.reduce(function(acumulador, valor, indice, array) {
//     acumulador += valor;
//     //console.log(acumulador, valor);
//     return acumulador;
// }, 0);

//pares
// const total = numeros.reduce(function(acumulador, valor) {
//     if (valor % 2 === 0) acumulador.push(valor);
//     return acumulador;
// }, []);

//dobro
// const total = numeros.reduce(function(acumulador, valor) {
//     acumulador.push(valor * 2);
//     return acumulador;
// }, []);

// console.log(total);

const pessoas = [
    { nome: 'ze', idade: 30 },
    { nome: 'roela', idade: 24 },
    { nome: 'josney', idade: 33 },
];
//mais velho
const maisVelho = pessoas.reduce(function(acumulador, valor) {
    if (acumulador.idade > valor.idade) return acumulador;
    return valor;
});

console.log(maisVelho);