import { Coureur } from "./coureur.js";

const monApp = {
    data() {
        return{
            listeCoureurs: [],
            paysDisponibles:[
                "Allemagne",
                "Autriche",
                "Belgique",
                "Espagne",
                "France",
                "Grèce",
                "Italie",
                "Pays-bas",
                "Pologne",
                "Portugal"
            ]
        }
    },
    async created(){
        let response = await fetch('./data/resultat10000metres.json');
        let json = await response.json();

        json.forEach(coureurs =>{
            this.ajouterCoureus(coureurs);
        });
    },
    methods: {
        ajouterCoureus(_coureur) {
            let monCoureur = new Coureur(_coureur.nom, _coureur.pays, _coureur.temps );
            // Ajouter le nouvel étudiant à la liste avec push
            this.listeCoureurs.push(monCoureur);

            this.listeCoureurs.sort((a,b) => a.temps - b.temps);
        }
    },
    computed: {
        nombreCoureurs(){
            return this.listeCoureurs.length 
        },
        nomGagnant(){
            if (this.listeCoureurs.length === 0) {
                return "Aucun coureur"; // Si la liste est vide
            }
            const gagnant = this.listeCoureurs[0]; // Le premier coureur (le plus rapide)
            return `${gagnant.nom}` 
        } 
    }
}

const vm = Vue.createApp(monApp);
vm.mount('#app');