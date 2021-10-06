/**
 * map();
 */

const pessoas = [
    { id: 3, nome: 'jose' },
    { id: 2, nome: 'josney' },
    { id: 1, nome: 'joselito' },
];

//ordem crescente
// const novasPessoas = {};
// for (pessoa of pessoas) {
//     const { id } = pessoa
//     novasPessoas[id] = {...pessoa };
// }

//mantem ordem
const novasPessoas = new Map();
for (pessoa of pessoas) {
    const { id } = pessoa
    novasPessoas.set(id, {...pessoa });
}

//traz o valir desejado baseado no id
//console.log(novasPessoas.get(2));
novasPessoas.delete(2);
console.log(novasPessoas);