

const monApp = {
    data() {
        return{
            listEmployer: []
        }
    },
    computed: {
        nombreTravailleurs() {
            return this.listEmployer.length
        }
    },
    async created(){
        let response = await fetch ('./data/eval.json');
        let json = await response.json();
        this.listEmployer = json.map(employer => {
            // Séparer le nom nom complet en nom et prénom
            const [prenom, ...nom] = employer.fullname.split(" ");
            return{
                ...employer,
                prenom: prenom,
                nom: nom.join(" ")//Rejoindre le reste comme nom
            }
        });
        this.listEmployer.sort((a,b) => b.grade - a.grade);
    }
}
Vue.createApp(monApp).mount('#app');

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
*/