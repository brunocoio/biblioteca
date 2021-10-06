/**
 * tratamento form
 */
function trataform() {
  const form = document.querySelector('.form');
  const resultado = document.querySelector('.resultado');
  const pessoas = [];

  function recebeEventoForm(evento) {
    evento.preventDefault();

    const nome = form.querySelector('.nome');
    const sobrenome = form.querySelector('.sobrenome');
    const peso = form.querySelector('.peso');
    const altura = form.querySelector('.altura');

    pessoas.push({
      nome: nome.value,
      sobrenome: sobrenome.value,
      peso: peso.value,
      altura: altura.value,
    });
    console.log(pessoas);

    resultado.innerHTML += `dados enviados`;
  }
  //quando foi efetuaro o submit irá aplicar a funcao
  form.addEventListener('submit', recebeEventoForm);
}
trataform();