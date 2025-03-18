const response = await fetch('./data/collectionPays.json');
const lesPays = await r.json();
console.log(lesPays);
