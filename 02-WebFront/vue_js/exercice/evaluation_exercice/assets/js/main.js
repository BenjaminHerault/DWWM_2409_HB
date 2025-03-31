import { Etudiant } from './Etudiant.js';

const monApp = {
    data() {
        return{
            listEtudiants: [],
        }
    },
    methods: {
        ajouterEtudiant(_etudiant) {
            //_etudiant = { fullname: "Armanetti Michaël", grade: 12 }
            try {
                // crée un nouvelle étudiant avec le nom et la note
                let monEtudiant = new Etudiant(_etudiant.fullname, _etudiant.grade);

                // Ajouter le nouvel étudiant à la liste avec push
                this.listEtudiants.push(monEtudiant);
                
                // ordonner la liste par note décroissante
                this.listEtudiants.sort((a,b) => b.grade - a.grade);

                _etudiant.fullname = ""; // réinitialiser le champ fullname
                _etudiant.grade = null; // réinitialiser le champ grade
            }
            catch (error) {
                alert(error.message);
            }
        }
    }, 
    computed: { // computed pour faire les calculs 
        nombreEtudians() {
            return this.listEtudiants.length
        },
        moyenneEtudiants(){
            if (this.listEtudiants.length === 0) 
                return 0;
            const total = this.listEtudiants.reduce((sum, etudians) => sum + etudians.grade, 0);
            return (total / this.listEtudiants.length).toFixed(2);
        },
        nombreEtudiansSuppMoyenne(){
            return this.listEtudiants.filter(etudians => etudians.grade > this.moyenneEtudiants).length;
        }
    },
    async created(){
        let response = await fetch ('./data/eval.json');
        let json = await response.json();

        json.forEach(etudiant => {
            this.ajouterEtudiant(etudiant);
        });
    }
}

const vm = Vue.createApp(monApp);

vm.component('ajout-etudiant', { // le nom du composant
    emits: ['nouvellenote'],
    data() {
        return { 
            fullname: '',
            grade: null
        }
    },
    methods: {
        ajouterEtudiant() {
            try{
                let nouvelEtudiant = {
                    fullname: this.fullname,
                    grade: this.grade,
                }
                // Émettre l'événement pour le parent
                this.$emit('nouvellenote', nouvelEtudiant);
    
                // Réinitialiser les champs après l'ajout
                this.fullname = '';
                this.grade = null;
            }
            catch (error) {
                alert(error.message);
            }
        }
    },
    template: `
    <form @submit.prevent="ajouterEtudiant">
        <label for="fullname">Prénom Nom :</label>
        <input type="text" id="fullname" v-model="fullname" placeholder="Prénom Nom " required>

        <br>

        <label for="note">Note :</label>
        <input type="number" id="note" v-model.number="grade" min="0" max="20" placeholder="Note" required>

        <br>

        <button id="monBouton" type="submit">Ajouter</button>
    </form>
                    `
});

vm.mount('#app');


// espace commentaite 
/*
map :
Pour transformer les données sans modifier le tableau d'origine.
C'est une méthode propre et concise pour appliquer une transformation à chaque élément d'un tableau.

split(" ") : Divise une chaîne en un tableau de mots.
Déstructuration [prenom, ...nom] :
prenom : Le premier mot.
nom : Le reste des mots (sous forme de tableau).
nom.join(" ") : Rejoint les mots restants en une chaîne.


reduce() :
La méthode reduce() applique une fonction qui est un « accumulateur » et qui traite chaque valeur d'une liste (de la gauche vers la droite) afin de la réduire à une seule valeur.
exemple : 1, 2, 3, 4
car on additionne tout les nombres 
va donne 10 


filter pour sélectionner les étudiants au-dessus de la moyenne :

La méthode .filter() retourne un tableau contenant uniquement les étudiants ayant une note supérieure à la moyenne.
etudiant.grade > this.moyenneEtudiants : Vérifie si la note de l'étudiant est supérieure à la moyenne.
length pour compter les étudiants :

Après avoir filtré les étudiants, .length retourne le nombre total d'étudiants au-dessus de la moyenne.


Validation des champs :

Vérifie que le champ fullname n'est pas vide.
Vérifie que la note (grade) est comprise entre 0 et 20.
Séparation et validation du nom et prénom :

Utilise .trim() pour supprimer les espaces inutiles.
Divise fullname en prenom et nom avec .split(" ").
Vérifie que le prénom et le nom contiennent au moins 2 lettres.
Formatage du nom et prénom :

Utilise charAt(0).toUpperCase() pour mettre la première lettre en majuscule.
Utilise .slice(1).toLowerCase() pour mettre le reste en minuscules.
Formate le prénom et le nom séparément.
Ajout de l'étudiant :

Ajoute l'étudiant avec les noms formatés et la note.
Calcule si l'étudiant a obtenu la moyenne (obtenu: "Oui" ou "Non").
*/