/**
 * desestruturacao
 * utilizacao de ..var para receber o 'resto/spred'
 */

const numeros = [1000, 2000, 3000, 4000];
const [um, dois, ...resto] = numeros;
console.log(resto);