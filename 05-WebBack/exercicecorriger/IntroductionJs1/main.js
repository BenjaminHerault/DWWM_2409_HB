function plus(){
    let nbclick= Number(document.querySelector("#compteur").textContent);
   
    // console.log(nbclick); pour voir si sa marche
    document.getElementById('compteur').textContent = nbclick+1;
}
function rest(){
    nbclick= Number(document.querySelector("#compteur").textContent);
    document.getElementById('compteur').textContent = 0;
};



const btn=document.querySelector("#boutonAjout");
btn.addEventListener("click",plus);

const btnRei=document.querySelector("#boutonRei");
btnRei.addEventListener("click",rest);

// btn=document.querySelector("#boutonAjout");
// btn.addEventListener("click",rest);
/*function() {
   
    let nbclick= Number(document.querySelector("#compteur").textContent);
   console.log(nbclick);
    
    document.getElementById('compteur').textContent = nbclick+1;
}*/
 






