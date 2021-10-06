/**
 * usando babel
 */

/**
 * npm init -v
 * npm init -v
 * 
 * npm install --save-dev @babel/cli @babel/preset-env @babel/core
 * 
 * .gitignore (node_modules)
 * 
 * npx babel main.js -o bundle.js --presets=@babel/env
 */
const nome = 'ze';
const obj = { nome };
const novoObj = {...obj };

class Pessoa {
    constructor(nome, sobrenome) {
        this.nome = nome;
        this.sobrenome = sobrenome;
    }
}