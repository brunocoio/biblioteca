/**
 * array map
 */

// const numeros = [5, 50, 80, 1, 2, 3, 5, 8, 7, 11, 15, 22, 27];
// const numerosEmDobro = numeros.map(valor  => valor * 2);

// console.log(numerosEmDobro);



const pessoas = [
    { nome: 'ze', idade: 30 },
    { nome: 'roela', idade: 24 },
    { nome: 'josney', idade: 33 },
];

const nomes = pessoas.map(obj => obj.nome);
//const idades = pessoas.map(obj => obj.idade);
const idades = pessoas.map(obj => ({ Idade: obj.idade }));

const comIds = pessoas.map(function(obj, indice) {
    //obj.id = indice;//alteracao do obj original
    //criando novo obj
    const newObj = {...obj };
    newObj.id = indice;
    return newObj;
});

console.log(pessoas);
console.log(nomes);
console.log(idades);
console.log(comIds);