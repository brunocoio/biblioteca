/**
 * switch case
 */

function getDiaSemanaTexto(diaSemana) {
    let diaSemanaTexto;

    switch (diaSemana) {
        case 0:
            diaSemanaTexto = 'Dom';
            return diaSemanaTexto;
            //break;
        case 1:
            diaSemanaTexto = 'Seg';
            return diaSemanaTexto;
            //break;
        case 2:
            diaSemanaTexto = 'Ter';
            return diaSemanaTexto;
            //break;
        case 3:
            diaSemanaTexto = 'Qua';
            return diaSemanaTexto;
            //break;
        case 4:
            diaSemanaTexto = 'Qui';
            return diaSemanaTexto;
            //break;
        case 5:
            diaSemanaTexto = 'Sex';
            return diaSemanaTexto;
            //break;
        case 6:
            diaSemanaTexto = 'Sáb';
            return diaSemanaTexto;
            //break;
        default:
            diaSemanaTexto = 'Inválido';
            return diaSemanaTexto;
            //break;
    }
    return diaSemanaTexto;
}

const data = new Date();
let diaSemana = data.getDay();
const diaSemanaTexto = getDiaSemanaTexto(diaSemana);

console.log(diaSemanaTexto);