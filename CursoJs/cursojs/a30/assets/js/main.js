// const h1 = document.querySelector('.container h1');
// const data = new Date();


// function getDiaSemanaTexto(diaSemana) {
//     let diaSemanaTexto;

//     switch (diaSemana) {
//         case 0:
//             diaSemanaTexto = 'Dom';
//             return diaSemanaTexto;
//         case 1:
//             diaSemanaTexto = 'Seg';
//             return diaSemanaTexto;
//         case 2:
//             diaSemanaTexto = 'Ter';
//             return diaSemanaTexto;
//         case 3:
//             diaSemanaTexto = 'Qua';
//             return diaSemanaTexto;
//         case 4:
//             diaSemanaTexto = 'Qui';
//             return diaSemanaTexto;
//         case 5:
//             diaSemanaTexto = 'Sex';
//             return diaSemanaTexto;
//         case 6:
//             diaSemanaTexto = 'Sáb';
//             return diaSemanaTexto;
//         default:
//             diaSemanaTexto = 'Inválido';
//             return diaSemanaTexto;
//     }
// }

// function getNomeMes(numeroMes) {
//     let nomeMes;

//     switch (numeroMes) {
//         case 0:
//             nomeMes = 'Jan';
//             return nomeMes;
//         case 1:
//             nomeMes = 'Fev';
//             return nomeMes;
//         case 2:
//             nomeMes = 'Mar';
//             return nomeMes;
//         case 3:
//             nomeMes = 'Abr';
//             return nomeMes;
//         case 4:
//             nomeMes = 'Mai';
//             return nomeMes;
//         case 5:
//             nomeMes = 'Jun';
//             return nomeMes;
//         case 6:
//             nomeMes = 'Jul';
//             return nomeMes;
//         case 7:
//             nomeMes = 'Ago';
//             return nomeMes;
//         case 8:
//             nomeMes = 'Set';
//             return nomeMes;
//         case 9:
//             nomeMes = 'Out';
//             return nomeMes;
//         case 10:
//             nomeMes = 'Nov';
//             return nomeMes;
//         case 11:
//             nomeMes = 'Dez';
//             return nomeMes;
//         default:
//             nomeMes = 'Inválido';
//             return nomeMes;
//     }
// }

// function doisDigitos(num) {
//     return num >= 10 ? num : `0${num}`;
// }

// function criaData(data) {
//     const diaSemana = data.getDay();
//     const numeroMes = data.getMonth();

//     const nomeDia = getDiaSemanaTexto(diaSemana);
//     const nomeMes = getNomeMes(numeroMes);

//     return `${nomeDia}, ${doisDigitos(data.getDate())} de ${nomeMes} de ${data.getFullYear()} ${doisDigitos(data.getHours())}:${doisDigitos(data.getMinutes())}`;
// }

// h1.innerHTML = criaData(data);
/**
 * maneira 2
 */
// const h1 = document.querySelector('.container h1');
// const data = new Date();
// const opcoes = {
//     dateStyle: 'full',
//     timeStyle: 'short'
// };
// h1.innerHTML = data.toLocaleDateString('pt-BR', opcoes);

/**
 * maneira 3
 */
const h1 = document.querySelector('.container h1');
const data = new Date();


function getDiaSemanaTexto(diaSemana) {
    const diasSemana = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'];
    return diasSemana[diaSemana];
}

function getNomeMes(numeroMes) {
    const meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
    return meses[numeroMes];
}

function doisDigitos(num) {
    return num >= 10 ? num : `0${num}`;
}

function criaData(data) {
    const diaSemana = data.getDay();
    const numeroMes = data.getMonth();

    const nomeDia = getDiaSemanaTexto(diaSemana);
    const nomeMes = getNomeMes(numeroMes);

    return `${nomeDia}, ${doisDigitos(data.getDate())} de ${nomeMes} de ${data.getFullYear()} ${doisDigitos(data.getHours())}:${doisDigitos(data.getMinutes())}`;
}

h1.innerHTML = criaData(data);