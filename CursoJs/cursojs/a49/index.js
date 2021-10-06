/**
 * funcoes
 * first class objects
 * 
 */
//function hoisting
function func1() {
    console.log('padrao');
}
func1();

//function expression
const funcDado = function() {
    console.log('um dado');
}
funcDado();

//funcao que executa funcao
function executaFuncao(funcao) {
    funcao();
}
executaFuncao(funcDado);

//arrow function
const funcaoArrow = () => {
    console.log('arrow');
}
executaFuncao(funcaoArrow);

//func dentro do obj
const obj = {
    //falar() {
    falar: function() {
        console.log('blablabla');
    }
}
obj.falar();