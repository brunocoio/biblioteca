const numeros = [1, 2, 3, 4, 5];

for (let numero of numeros) {
    //continue pula a proxima ação avançando para proxima validação
    if (numero === 2) {
        continue;
    }
    //break para a validação não terminando as próximas ações
    if (numero === 5) {
        break;
    }

    console.log(numero);
}