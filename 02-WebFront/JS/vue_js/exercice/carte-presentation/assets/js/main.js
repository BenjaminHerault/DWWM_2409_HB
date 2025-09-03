const monApp = {
    data() {
        return {
            user: {
                titre: "",
                nom: "",
                prenom: "",
                job: "",
                age: "",
                mail: "",
                tel: "",
                texte_prestation: "",
            },
        };
    },
    async mounted() {
        let response = await fetch("./data/info.json");
        let json = await response.json();
        // info.json renvoie un tableau -> on prend le premier élément si nécessaire
        const data = Array.isArray(json) ? json[0] : json;

        // Normaliser l'objet user : garder les clés existantes et ajouter des alias
        this.user = {
            titre: data.titre || "",
            nom: data.nom || "",
            prenom: data.prenom || "",
            job: data.job || "",
            age: data.age || "",
            mail: data.mail || "",
            tel: data.tel || "",
            texte_prestation: data.texte_prestation || "",
        };
    },
};

const vm = Vue.createApp(monApp);
vm.mount("#app");
