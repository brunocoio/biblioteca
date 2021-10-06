/**
 * factory functions + prototypes
 */

//compor - mixing
const falar = {
    falar() {
        console.log(`${this.nome} está falando`);
    }
};
const comer = {
    comer() {
        console.log(`${this.nome} está comendo`);
    }
};
const beber = {
    beber() {
        console.log(`${this.nome} está bebendo`);
    }
};

// const pessoaPrototype = {...falar, ...comer, ...beber };
const pessoaPrototype = Object.assign({}, falar, comer, beber);
//!--compor - mixing

function criaPessoa(nome, sobrenome) {
    return Object.create(pessoaPrototype, {
        nome: { value: nome },
        sobrenome: { value: sobrenome },
    });
};
const p1 = criaPessoa('ze', 'roela');
const p2 = criaPessoa('josney', 'roelito');
console.log(p1.comer(), p2.beber());