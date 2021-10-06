/**
 * prototype
 */
//construtora -> molde (classe)
function Pessoa(nome, sobrenome) {
    this.nome = nome;
    this.sobrenome = sobrenome;
    //this.nomeCompleto = () => this.nome + ' ' + this.sobrenome;
}

Pessoa.prototype.nomeCompleto = () => this.nome + ' ' + this.sobrenome;

//instancia
const pessoa1 = new Pessoa('ze', 'roela'); // <- Pessoa = funcao construtora
const data = new Date();

console.dir(pessoa1);
console.dir(data);