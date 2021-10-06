/**
 * propoerty e properties
 */
// function Produto(nome, preco, estoque) {
//     this.nome = nome;
//     this.preco = preco;
//     //this.estoque = estoque; //privado
//     Object.defineProperty(this, 'estoque', {
//         enumerable: true, //mostra chave/valor
//         value: estoque,
//         writable: false, //editavel
//         configurable: false, //configuravel (deletar /reconfigurar)
//     });
// };

// const p1 = new Produto('camiseta', 20, 3);
// //console.log(p1);
// console.log(Object.keys(p1));

// for (const chave in p1) {
//     console.log(chave);
// }

function Produto(nome, preco, estoque) {
    //this.estoque = estoque; //privado
    Object.defineProperty(this, 'estoque', {
        enumerable: true, //mostra chave/valor
        value: estoque,
        writable: false, //editavel
        configurable: false, //configuravel (deletar /reconfigurar)
    });
    Object.defineProperties(this, {
        nome: {
            enumerable: true, //mostra chave/valor
            value: nome,
            writable: true, //editavel
            configurable: true, //configuravel (deletar /reconfigurar)
        },
        preco: {
            enumerable: true, //mostra chave/valor
            value: preco,
            writable: false, //editavel
            configurable: false, //configuravel (deletar /reconfigurar)
        },
    });
};

const p1 = new Produto('camiseta', 20, 3);
//console.log(p1);
console.log(Object.keys(p1));

for (const chave in p1) {
    console.log(chave);
}