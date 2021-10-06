/**
 * propoerty e properties | get e set
 */
function Produto(nome, preco, estoque) {
    this.nome = nome;
    this.preco = preco;

    let estoquePrivado = estoque;

    Object.defineProperty(this, 'estoque', {
        enumerable: true, //mostra chave/valor
        //value: estoque,
        //writable: true, //editavel
        configurable: true, //configuravel (deletar /reconfigurar)
        get: function() {
            return estoquePrivado;
        },
        set: function(valor) {
            if (typeof valor !== 'number') {
                console.log('nao é um valor valido');
                return;
            }
            estoquePrivado = valor;
        }
    });
};

function criaProduto(nome) {
    return {
        get nome() {
            return nome;
        },
        set nome(valor) {
            valor = valor.replace('roela', '');
            nome = valor;
        },
    };
};

// const p1 = new Produto('camiseta', 20, 3);
// //console.log(p1);
// p1.estoque = 500;
// console.log(p1.estoque);

const p2 = criaProduto('camiseta');
p2.nome = 'ze roela';
console.log(p2.nome);