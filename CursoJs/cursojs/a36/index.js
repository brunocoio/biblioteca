/**
 * for in lê índices ou chaves do objeto
 */
const pessoa = {
    nome: 'josney',
    sobrenome: 'roela',
    idade: 30,
};

for (let chave in pessoa) {
    //nome do objeto e o valor do objeto
    console.log(chave, pessoa[chave]);
}