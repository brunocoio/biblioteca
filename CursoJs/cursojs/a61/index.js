/**
 * function geradoras
 */

// function* geradora1() {
//     //exemplo1
//     yield 'valor 1';
//     //exemplo2
//     yield 'valor 2';
//     //exemplo3
//     yield 'valor 3';
// }

// const g1 = geradora1();

//apresenta { value: 'valor 1', done: false }
//console.log(g1.next());

//apresenta valor
//console.log(g1.next().value);

//apresenta todos os valores
// for (let valor of g1) {
//     console.log(valor);
// }

// function* geradora2() {
//         let i = 0;
//         while (true) {
//             yield i;
//             i++;
//         }
//     }
// const g2 = geradora2();
// console.log(g2.next().value);

//

function* geradora3() {
    yield 0;
    yield 1;
    yield 2;
}

function* geradora4() {
    yield* geradora3();
    yield 3;
    yield 4;
    yield 5;
}
const g4 = geradora4();
for (let valor of g4) {
    console.log(valor);
}