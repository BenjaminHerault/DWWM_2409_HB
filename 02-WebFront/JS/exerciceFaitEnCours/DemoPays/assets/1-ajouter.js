
const monPays = {
    "country_code": "FR",
    "country_name": "France"
}

const r = await fetch('./data/collectionPays.json');
const j = await r.json();
console.log(j);

for(let p of j) {
    if(p.country_name.length < 4) {
        console.log(p);
    }
}