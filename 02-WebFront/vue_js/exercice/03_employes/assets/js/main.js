import { Employes } from "./Employes.js";

const monApp = {
    data() {
        return {
            listEmployes: [],
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
};
const vm = Vue.createApp(monApp);
vm.mount("#app");
