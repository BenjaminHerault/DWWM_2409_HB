fetch("https://arfp.github.io/tp/web/javascript/02-zipcodes/zipcodes.json") // on récupère le json
  .then((Response) => {
    return Response.json();
  })
  .then(data => {console.log(data);
    remplirDataList(data);

    const btnValidation = document.querySelector("#valider");
    btnValidation.addEventListener('click', function(){
        const zip = document.querySelector("#cp");
        let arraySolution = [];
        arraySolution = data.filter(obj => obj.nomCommune == zip.value || obj.codePostal == zip.value);

        if(arraySolution != "undefined"){
            //document.querySelector("#result").innerHTML = `Nom de la commune : ${solution.nomCommune}<br>Code postal : ${solution.codePostal}`;
        document.querySelector("#result").innerHTML = "";
            arraySolution.forEach(objetVille => {
                document.querySelector("#result").innerHTML += `Nom de la commune : ${objetVille.nomCommune}<br>Code postal : ${objetVille.codePostal}<br><br>`;
        });
        
    zip.value = "";       
    zip.focus();

        }

        else {
            document.querySelector("#result").innerHTML = `Commune non trouvée`;
        }
    })
  })
  .catch(error => alert("message : " + error));


  // création d'une fonction pour afficher les suggestions
  function remplirDataList(data){

    const datalist = document.getElementById("suggestions");

    for(let i = 0; i < data.length; i++) { 
    const myOption = new Option(); // création d'un constructeur
    myOption.value = data[i].codeCommune;
    myOption.textContent = data[i].nomCommune + " cp : " + data[i].codePostal;

    datalist.appendChild(myOption);
    }
  }