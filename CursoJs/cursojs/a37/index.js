const nome = ['nome', 'sobrenome'];
//for clássico usado com iteraveis (array e strings)
// for (let i = 0; i < nome.length; i++) {
//     console.log(nome[i]);
// }

//for in funciona com array e objeto para indice e chave (array, string e objeto)
// for (let i in nome) {
//     console.log(nome[i]);
// }

//for of não utilizado em objeto, usado com iteraveis (array e strings)
for (let valor of nome) {
    console.log(valor);
}

nome.forEach(function(valor, indice) {
    console.log(valor, indice);
});