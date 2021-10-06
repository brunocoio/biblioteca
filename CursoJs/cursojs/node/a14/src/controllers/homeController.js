const HomeModel = require('../models/HomeModel');

HomeModel.create({
        titulo: 'titulo teste2',
        descricao: 'desc teste2'
    })
    .then(dados => console.log(dados))
    .catch(e => console.log(e));

exports.paginaInicial = (req, res) => {
    res.render('index');
    return;
};

exports.trataPost = (req, res) => {
    res.send(req.body);
    return;
};