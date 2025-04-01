import { Coureur } from "./coureur.js";

const monApp = {
    data() {
        return{
            listeCoureurs: [],
            paysSelectionne: []
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
        },
        caseCochee(e) {
            let cocheOuPas = e.target.checked; // true or false
            let monPays = e.target.value; // nom du pays associé à la case

            if(cocheOuPas == true) {
                this.paysSelectionne.push(monPays);
            } else {
                this.paysSelectionne = this.paysSelectionne.filter(unPays => unPays != monPays);
            }

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
        } ,
        coureursFiltre() {
            // si aucun pays n'est sélectionné, retourner tous les coureurs
            if(this.paysSelectionne.length === 0) {
                return this.listeCoureurs;
            }
            // sinon, filtrer les coureurs par pays sélectionnés
            return this.listeCoureurs.filter(coureur => this.paysSelectionne.includes(coureur.pays));
        }
    }
}

const vm = Vue.createApp(monApp);
vm.mount('#app');