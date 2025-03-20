//objet littéral JS
const myEmployee = {
    lastname: "Doe",
    firstname: "John",
    birthday: "1981-11-12",
    salary: 2150
}


console.log(myEmployee['lastname']+'\n');

console.log(myEmployee.firstname);


for (const cle in myEmployee) {
   
console.log( cle + ": " + myEmployee[cle]);

}

// tableau JS indicé on peut aussi utilisé les []
let tabEmploye=new Array("Doe","John","1981-11-12",2150, "manager");

let partEmploye= tabEmploye.slice(2,4);



for (let i= 0; i < partEmploye.length; i++) {

    console.log( partEmploye[i]+"\n");    
}
//code pour créer des elémément li dans une page html

for (const key in myEmployee) {

    let monItem = document.createElement("li");
    if (key == "salary") {
        monItem.textContent = key + " : " + myEmployee[key] + " €";
    } else {

        monItem.textContent = key + " : " + myEmployee[key];
    }
    monItem.setAttribute("style", "color:green;font-size:1.4rem");
    document.getElementById("affichage").appendChild(monItem);
}
// const object = { a: 1, b: 2, c: 3 };

// for (const property in object) {
//   console.log(`${property}: ${object[property]}`);
// }