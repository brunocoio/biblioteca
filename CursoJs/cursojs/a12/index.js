let varA = 'A';
let varB = 'B';
let varC = 'C';
let varD = varA;

varA = varB;
varB = varC;
varC = varD;
console.log(varA, varB, varC);
//outra maneira
varA = 'A';
varB = 'B';
varC = 'C';
[varA, varB, varC] = [varB, varC, varA]
console.log(varA, varB, varC);