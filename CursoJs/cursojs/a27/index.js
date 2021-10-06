/**
 * ternário
 * var ? true : false ;
 */

const pontuacaoUsuario = 999;

(pontuacaoUsuario >= 1000) ? console.log('vip'): console.log('normal');

const nivelUsuario = pontuacaoUsuario >= 1000 ? 'vip' : 'normal';
console.log(nivelUsuario);