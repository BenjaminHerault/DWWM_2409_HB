
/*style */ 
let divStyle = document.querySelector("div");
let hrStyle = document.querySelector("hr");
let mainStyle = document.querySelector("main");
let formStyle = document.querySelector("form");
let prenomlStyle = document.querySelector("#prenom");
let ageStyle = document.querySelector("#age");
let validerStyle = document.querySelector("#boutonValider");
let viderStyle = document.querySelector("#boutonVider");
let spanStyle = document.querySelector(".spanStyle");

//mainStyle.style.fontFamily = "Verdana";// marche pas
mainStyle.setAttribute("style", "font-family:Verdana;");

formStyle.setAttribute("style", "margin-left: 10px; margin-right: 10px;");

divStyle.setAttribute(
    "style", "border: 2px solid blue; width: 800px; margin-left: auto; margin-right: auto; margin-top: 50px;");

// divStyle.style.border = "2px solid blue";
// divStyle.style.width = "800px";
// divStyle.style.marginLeft = "auto";
// divStyle.style.marginRight = "auto";
// divStyle.style.marginTop = "50px";

hrStyle.style.border = "1px solid ";

validerStyle.style.color = "blue";
validerStyle.style.border = "2px solid blue";

viderStyle.style.color = "blue";
viderStyle.style.border = "2px solid blue";

prenomlStyle.style.border = "2px solid blue";
prenomlStyle.style.margin = "0px 10px";
prenomlStyle.style.width = "120px";


ageStyle.style.border = "2px solid blue";
ageStyle.style.margin = "0px 10px";
ageStyle.style.width = "50px";