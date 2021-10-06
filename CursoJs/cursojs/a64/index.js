/**
 * concatenar arrays
 */

const a1 = [1, 2, 3];
const a2 = [4, 5, 6];
//const a3 = a1.concat(a2);
//pode se usar o rest operator ...spread
const a3 = [...a1, ...a2, ...[7, 8, 9], 'teste'];
console.log(a3);