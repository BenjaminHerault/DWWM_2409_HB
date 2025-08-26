import { Control_saisies } from "./Controler_saisies.js";

const monApp = {
    data() {
        return {
            nom: "Herault",
            prenom: "Benjamin",
        };
    },
    async created() {
        let response = await fetch();
    },
};
