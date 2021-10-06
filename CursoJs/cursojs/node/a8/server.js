const express = require('express');
const app = express();
//habilitar leitura de post
app.use(express.urlencoded({ extended: true }));

//         Criar   ler   atualizar apagar
// CRUD -> CREATE, READ, UPDATE,   DELETE
//         POST    GET   PUT       DELETE

app.get('/', (req, res) => {
    res.send(`
  <form action="/" method="POST">
  Nome: <input type="text" name="nome">
  <button>Enviar</button>
  </form>
  `);
});

app.get('/testes/:idUsuarios?/:parametro?', (req, res) => {
    console.log(req.params); //estrutura de pastas
    console.log(req.query); //variaveis
    res.send(req.params);
});

app.post('/', (req, res) => {
    console.log(req.body);
    res.send(`enviado foi ${req.body.nome}`);
});

app.get('/contato', (req, res) => {
    res.send('Obrigado por entrar em contato com a gente.');
});

app.listen(3000, () => {
    console.log('Acessar http://localhost:3000');
    console.log('Servidor executando na porta 3000');
});