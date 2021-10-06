const nome = 'ze roela';
const alunos = ['josney','creuzemira'];
//alunos[alunos.length] = 'joselito';//add no final
alunos.pop()//tira o ultimo registro = alunos.pop();//traz o registro que foi removido do array
alunos.shift();//tira o primeiro registro
alunos.push('joselito');//add no final
alunos.unshift('paquitao');//add no inicio
//delete alunos[1];//item remove o registro mas mantem o array em branco
console.log(alunos);
//console.log(alunos.slice(0, 1));//apresenta o intervalo desejado
//console.log(alunos instanceof Array);//valida se é um array