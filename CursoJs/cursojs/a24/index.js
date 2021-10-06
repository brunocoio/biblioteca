/**
 * 0-11 dia
 * 12-17 tarde
 * 18-23 noite
 */
const hora = 19;
if(hora >= 0 && hora <= 11){
    console.log('dia');
}else if(hora >= 12 && hora <= 17){
    console.log('tarde');
}else if(hora >= 18 && hora <= 23){
    console.log('noite');
}else{
    console.log('erro');
}