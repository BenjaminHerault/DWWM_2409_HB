let divStyle = document.querySelector("div");
let mainStyle = document.querySelector("main");
let formStyle = document.querySelector("form");
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



