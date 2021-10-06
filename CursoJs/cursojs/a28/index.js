/**
 * data
 * 60 * 60 * 1 * 1000 equivale a uma hora em millisegundos
 * 60 * 60 * 24 * 1000 equivale a 24 horas em millisegundos
 */

// const data = new Date();
// console.log(data.toString());

// console.log(data.getDate()); //dia
// console.log(data.getMonth()); //mes - comeca em 0
// console.log(data.getFullYear()); //ano
// console.log(data.getHours()); //hora
// console.log(data.getMinutes()); //min
// console.log(data.getSeconds()); //seg
// console.log(data.getMilliseconds()); //mseg
// console.log(data.getDay()); //dia da semana - 0 - domingo 6 - sábado
// console.log(Date.now()); //timestamp - millisegundos

function doisDigitos(num) {
    return num >= 10 ? num : `0${num}`;
}

function formataData(data) {
    //console.log(data);
    const dia = doisDigitos(data.getDate());
    const mes = doisDigitos(data.getMonth() + 1);
    const ano = doisDigitos(data.getFullYear());
    const hor = doisDigitos(data.getHours());
    const min = doisDigitos(data.getMinutes());
    const seg = doisDigitos(data.getSeconds());

    return `${dia}/${mes}/${ano} ${hor}:${min}:${seg}`;
}

const data = new Date();
const dataBr = formataData(data);
console.log(dataBr);