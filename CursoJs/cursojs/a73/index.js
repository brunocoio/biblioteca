/**
 * metódos para objetos
 */

// // //variavel diferente referenciando ao mesmo obj
// // const produto = { nome: 'canecas', preco: 1.8 };
// // const outraCoisa = produto;
// // outraCoisa.nome = 'ze roela';
// // console.log(produto, outraCoisa);

// //variavel diferente copiando dados mas obj diferentes
// //const outraCoisa = {...produto };//uma opcao
// //const outraCoisa = {nome: produto.nome };//outra opcao
// const produto = { nome: 'canecas', preco: 1.8 };
// const outraCoisa = Object.assign({}, produto); //outra opcao
// outraCoisa.nome = 'ze roela';
// console.log(produto, outraCoisa);


const produto = { nome: 'produto', preco: 1.8 };
console.log(Object.getOwnPropertyDescriptor(produto, 'nome'));