/**
 * filtro array
 */
const numeros = [5, 50, 80, 1, 2, 3, 5, 8, 7, 11, 15, 22, 27];
const numerosFiltrados = numeros.filter(valor => valor > 10); //versão simplificada
// const numerosFiltrados = numeros.filter((valor, indice, array) => {
//     console.log(valor, indice, array);
//     return valor > 10; //if valor > 10 true
// });
//console.log(numerosFiltrados);

/**/

const pessoas = [
    { nome: 'ze', idade: 30 },
    { nome: 'roela', idade: 24 },
    { nome: 'josney', idade: 33 },
];

const pessoasComNomeGrande = pessoas.filter(valor => valor.nome.length >= 5);
//console.log(pessoasComNomeGrande);


const pessoasComIdade = pessoas.filter(valor => valor.idade > 30);
//console.log(pessoasComIdade);


const pessoasComNome = pessoas.filter(valor => valor.nome.toLowerCase().endsWith('a'));
//console.log(pessoasComNome[0].nome);
console.log(pessoasComNome);