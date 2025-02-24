function plus(){
    let nbclick= Number(document.querySelector("#compteur").textContent);
   
    console.log(nbclick);
    document.getElementById('compteur').textContent = nbclick+1;
}
function rest(){
   
    document.getElementById('compteur').textContent = 0;
}



const btn=document.querySelector("#boutonAjout");
btn.addEventListener("click",plus
  
);

/*function() {
   
    let nbclick= Number(document.querySelector("#compteur").textContent);
   console.log(nbclick);
    
    document.getElementById('compteur').textContent = nbclick+1;
}*/
 






