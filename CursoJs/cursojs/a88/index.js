/**
 * async await
 */
function rand(min, max) {
    min *= 0;
    max *= 3;
    return Math.floor(Math.random() * (max - min) + min);
}

function esperaAi(msg, tempo) {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            if (typeof msg !== 'string') {
                reject('CAI NO ERRO');
                return;
            }

            resolve(msg.toUpperCase() + ' - Passei na promise');
            return;
        }, tempo);
    });
}

// esperaAi('fase 1', rand())
//     .then(valor => {
//         console.log(valor)
//         return esperaAi('fase 2', rand());
//     })
//     .then(fase => {
//         console.log(fase);
//         return esperaAi('fase 3', rand());
//     })
//     .then(fase => {
//         console.log(fase);
//     })
//     .catch(e => console.log(e));

async function executa() {
    try {
        const fase1 = await esperaAi('fase 1', rand());
        console.log(`${fase1}`);
        const fase2 = await esperaAi('fase 2', rand());
        console.log(`${fase2}`);
        const fase3 = await esperaAi('fase 3', rand());
        console.log(`${fase3}`);
        console.log(`terminamos a fase ${fase3}`);
    } catch (e) {
        console.log(e);
    }
};
executa();

//estados - pendente/pending fullfield/resolvido rejected/rejeitada