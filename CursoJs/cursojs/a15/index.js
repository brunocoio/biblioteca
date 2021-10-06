//let num1 = 9;
//let num2 = Math.floor(num1);//arredonda para cima
//let num2 = Math.ceil(num1);//arredonda para baixo
//let num2 = Math.round(num1);//arredonda para mais proximo
//console.log(num2);
//console.log(Math.max(2,5,7,9,1,5,4,6,8,3));//identifica o maior
//console.log(Math.min(2,5,7,9,1,0.5,4,6,8,3));//identifica o menor
//console.log(Math.random());//gera numeros randomicamente
//console.log(Math.random() *  (10 -5) +5);//gera numeros randomicamente
//raiz quadrada
//console.log(num1 ** (1/2) );
//console.log(num1 ** 0.5 );
//console.log(100/0); resultado é Infinity (errado)

const numero = Number(prompt(`digita um numero`));
const numeroTitulo = document.getElementById('numero-titulo');

numeroTitulo.innerHTML = numero;
texto.innerHTML = ``;
texto.innerHTML += `<p>Raiz ${numero ** (1/2)}</p>`;
texto.innerHTML += `<p>inteiro? ${Number.isInteger(numero)}</p>`;
texto.innerHTML += `<p>NaN? ${Number.isNaN(numero)}</p>`;
texto.innerHTML += `<p>arredonda baixo ${Math.floor(numero)}</p>`;
texto.innerHTML += `<p>arredonda cima ${Math.ceil(numero)}</p>`;
texto.innerHTML += `<p>2 casas decimais ${numero.toFixed(2)}</p>`;