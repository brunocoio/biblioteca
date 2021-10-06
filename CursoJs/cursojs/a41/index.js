function max(x, y) {
    if (x > y) return x;
    //else
    return y;

    //outra opção ternária
    return x > y ? x : y;
}

//arrow function
// const max2 = (x, y) => {
//     return x > y ? x : y;
// }

//arrow function ternário
const max2 = (x, y) => x > y ? x : y;

const maior = max(1, 2);
console.log(maior);

const maior2 = max2(1, 2);
console.log(maior2);