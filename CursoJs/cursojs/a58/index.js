/**
 * constructor function -> objetos (deve comecar com letra maiuscula)
 * factory function -> objetos
 */
function Pessoa(nome, sobrenome) {
    this.nome = nome;
    this.sobrenome = sobrenome;
}

const p1 = new Pessoa('ze', 'roela');