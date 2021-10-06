let num1 = 152.85;
let num2 = 2.15;
//let.toString(), a variavel e convertida para string
//console.log(num1.toString() + num2);
//console.log(typeof num1);//variável mantem tipo number
//console.log(num1.toString(2));//vira binário
//console.log(num1.toFixed(2));//casas decimais
//console.log(Number.isInteger(num1));//retorna true ou false
//console.log(Number.isNaN(num1));//verifica se for NaN true/false
//num1 = 0.8
//num += 0.1
//num += 0.1

//converte casas decimais precisa do toFixed e o parseFloat
//num1 = parseFloat(num1.toFixed(2));

//converte casas decimais com 100
num1 = ((num1 * 100) + (num2 * 100)) / 100;

console.log(num1);
console.log(Number.isInteger(num1));