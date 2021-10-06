// try { //executa
//     console.log('abre arquivo');
//     console.log('manipula e deu erro');
//     //ao identificar o erro não fecha o arquivo pois passa para o catch
//     console.log('fecha arquivo');
// } catch (e) { //executa quando tem erro
//     console.log('trata erro');
// } finally { //sempre executa - não obrigatório    
//     console.log('jeito certo de fechar arquivo manipulado');
// }

function retornaHora(data) {
    if (data && !(data instanceof Date)) {
        throw new TypeError('Esperando instância de Date.');
    }
    if (!data) {
        data = new Date();
    }

    return data.toLocaleTimeString('pt-BR', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    });
}

try {
    //retornaHora(new Date());
    const data = new Date('01-01-1970 12:58:12');
    const hora = retornaHora();
    console.log(hora);
} catch (e) {
    //tratar erro
    console.log(e);
} finally {
    console.log('fim');
}