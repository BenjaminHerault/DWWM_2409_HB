import { Coureur } from "./coureur.js";

const monApp = {
    data() {
        return{
            listeCoureurs: []
        }
    },
    async created(){
        let response = await fetch('./data/resultat10000metres.json');
        let json = await response.json();

        json.forEach(coureurs =>{
            this.ajouterCoureus(coureurs);
        });
    },

    // creaction d'un nouveau élement dans le tableaux 
    methods: {
        ajouterCoureus(_coureur) {
            let monCoureur = new Coureur(_coureur.nom, _coureur.pays, _coureur.temps );
            this.listeCoureurs.push(monCoureur);
        }
    }
}

const vm = Vue.createApp(monApp);
vm.mount('#app');