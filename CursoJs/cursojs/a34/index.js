/**
 * repeticao
 */

// console.log('linha 1');
// console.log('linha 2');
// console.log('linha 3');
//a opão para pular de x em x é aplicar na ultima condicao o i += valor
//for (let i = 0; i <= 5; i+= 3) {
// for (let i = 0; i <= 5; i++) {
//     console.log(`linha ${i}`);
// }

const valores = [1, 2, 3, 4, 5, 6]
for (let i = 0; i < valores.length; i++) {
    console.log(`linha`, valores[i]);
}