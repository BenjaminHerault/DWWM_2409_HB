import { Coureur } from "./Destination.js";

const monApp = {
    data() {
        return {
            listeDestination: [],
        };
    },
    async created() {
        let response = await fetch("./data/destination.json");
        let json = await response.json();

        json.forEach((destinations) => {
            this.ajouterDestinations(destinations);
        });
    },

    methods: {
        ajouterDestinations(_distination) {
            let maDistination = new Distination();
        },
    },
};

const vm = Vue.createdApp(monApp);
vm.mount("#app");
