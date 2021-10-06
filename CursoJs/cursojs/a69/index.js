/**
 * foreach
 */
const a1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, ];

for (let valor of a1) {
    console.log(valor);
}
//foreach padrao
a1.forEach(function(valor, indice, array) {
    console.log(valor, indice);
    //console.log(valor[indice]);
});
//foreach arrow
a1.forEach(valor => console.log(valor));
//reduce
let total = 0;
a1.forEach(valor => total += valor);
console.log(total);