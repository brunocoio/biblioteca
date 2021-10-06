/**
 * revisão obj
 */
//valores literais com construtores
//'' "" ``
//[]
// 123
//function

//literal
// const pessoa = {
//     nome: 'zé',
//     sobrenome: 'roela',
// };

// console.log(pessoa.nome);
// console.log(pessoa['nome']);

//construtor
// new object();
//[]

// const pessoa1 = new Object();
// pessoa1.nome = 'zé';
// pessoa1.sobrenome = 'roela';
// pessoa1.idade = 30;
// //delete pessoa1.nome;
// //console.log(pessoa1);
// pessoa1.falarNome = function() {
//     return (`${this.nome} é seu nome`);
// }
// pessoa1.getDataNascimento = function() {
//         const dataAtual = new Date();
//         return dataAtual.getFullYear() - this.idade;
//     }
//     //console.log(pessoa1.getDataNascimento());

// for (let chave in pessoa1) {
//     console.log(chave, pessoa1[chave]);
// }

/** */

//factory function / constructor function (modeles/padroes) / classes
//factory function
// function criaPessoa(nome, sobrenome) {
//     return {
//         nome,
//         sobrenome,
//         get nomeCompleto() {
//             return `${this.nome} ${this.sobrenome} `;
//         }
//     };
// };

// const p1 = criaPessoa('zé', 'roela');
// console.log(p1.nomeCompleto);
//caso não tenha o get deve se aplicar como nomeCompleto()

//constructor function (diferencial é o new, mudando comportamento), aplica o this no obj, não precisa de return
function Pessoa(nome, sobrenome) {
    this.nome = nome;
    this.sobrenome = sobrenome;
    //Object.freeze(this); //nao pode alterar o objeto
};
const p1 = new Pessoa('zé', 'roela');
console.log(p1);