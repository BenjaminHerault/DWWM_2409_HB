import { Employes } from "./Employes.js";

const monApp = {
    data() {
        return {
            listEmployes: [],
            sortKey: "employee_salary", // Clé de tri par défaut
            sortOrder: "asc", // Ordre de tri par défaut (ascendant)
        };
    },
    async created() {
        try {
            const url =
                "https://arfp.github.io/tp/web/javascript2/03-employees/employees.json";

            let response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Erreur HTTP : ${response.status}`);
            }
            // Convertir les données JSON en object JavaScript
            let json = await response.json();

            json.data.forEach((employes) => {
                this.ajouterEmployes(employes);
            });
        } catch (error) {
            console.error("Erreur lors du chargement des données :", error);
        }
    },
    methods: {
        ajouterEmployes(_employes) {
            let monEmployes = new Employes(
                _employes.id,
                _employes.employee_name,
                _employes.employee_salary,
                _employes.employee_age,
                _employes.profile_image
            );
            this.listEmployes.push(monEmployes);
        },
    },

    computed: {
        nombrEmploye() {
            return this.listEmployes.length;
        },
        TotalSalaire() {
            return this.listEmployes
                .reduce(
                    (total, employe) =>
                        total + parseFloat(employe.employee_salary),
                    0
                )
                .toFixed(2); // Retourne la somme des salaires avec deux décimales
        },
    },
};
const vm = Vue.createApp(monApp);
vm.mount("#app");

/*
Utilisez reduce pour calculer la somme des salaires.
*/
