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
            // Ajouter le nouvel coureur à la liste avec push
            this.listeCoureurs.push(monCoureur);

            // on trie avec sort dans l'autre croissant 
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
        },
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
        //pour caculer une moyenne
        moyenCourse(){
            if(this.listeCoureurs.length ===0)
                return "00min00s";
            const total = this.listeCoureurs.reduce((sum, coureur) => sum + coureur.temps, 0);
            const moyenne = Math.floor(total/ this.listeCoureurs.length);

            // Utiliser l'objet Coureur pour convertir le temps
            const coureurTemporaire = new Coureur("","", moyenne);
            return coureurTemporaire.convertirTemps(moyenne);
        },
        coureursFiltre() {
            // si aucun pays n'est sélectionné, retourner tous les coureurs
            if(this.paysSelectionne.length === 0) {
                return this.listeCoureurs;
            }
            // sinon, filtrer les coureurs par pays sélectionnés
            return this.listeCoureurs.filter(coureur => this.paysSelectionne.includes(coureur.pays));
        },
        ecartTemps() {
            if (this.listeCoureurs.length < 2) {
                return "Pas assez de coureurs"; // Si la liste contient moins de 2 coureurs
            }

            const tempsPremier = this.listeCoureurs[0].temps; // Temps du premier coureur (le plus rapide)
            // Calculer les écarts pour chaque coureur
            return this.listeCoureurs.map(coureur => {
                const ecart = coureur.temps - tempsPremier;
                return ecart 
            });
        }
    }
}

const vm = Vue.createApp(monApp);
vm.mount('#app');