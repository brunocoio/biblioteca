function criaPessoa(nome, sobrenome, idade){
    return{
        //nome: nome,
        //sobrenome: sobrenome,
        //idade: idade
        nome,sobrenome,idade,
    }
}

//objeto
const pessoa = criaPessoa('zé', 'roela', 69);
console.log(pessoa);