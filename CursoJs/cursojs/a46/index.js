/**
 * setinterval setTimeout
 */
function mostraHora() {
    let data = new Date();
    return data.toLocaleTimeString('pt-BR', {
        hour12: false
    });
}

// function funcaoDoInterval() {
//     console.log(mostraHora());
// }
//executa a cada millisegundos
//setInterval(funcaoDoInterval, 1000);

//outra opção
// setInterval(function() {
//     console.log(mostraHora());
// }, 1000);

const timer = setInterval(function() {
    console.log(mostraHora());
}, 1000);

//só executa 1x 
setTimeout(function() {
    clearInterval(timer);
}, 10000);