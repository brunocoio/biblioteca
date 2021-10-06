/**
 * revisao filter, map, reduce
 */
const numeros = [5, 50, 80, 1, 2, 3, 5, 8, 7, 11, 15, 22, 27];
//init
const numerosPares = numeros
    .filter(valor => valor % 2 === 0) //seleciona os pares
    .map(valor => valor * 2) //multiplica por dois
    .reduce((ac, valor) => ac + valor); //soma todos os numeros
//!fim
console.log(numerosPares);