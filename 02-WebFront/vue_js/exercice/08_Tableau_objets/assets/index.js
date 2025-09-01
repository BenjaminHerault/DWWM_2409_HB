
const monApp = {
    data() {
        return {
            nomUtilisateur: "",
            motDePasse: ""
        };
    },
    async mounted(){
        let response = await fetch("./data/info.json");
        let json = await response.json();
        const data = Array.isArray(json) ? json[0] : json;
    },
    methods: {
        verifierProfile(){

        }
    }
}













