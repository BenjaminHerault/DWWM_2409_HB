

const monApp = {
    data() {
        return{
            listEmployer: []
        }
    },
    async created(){
        let response = await fetch ('./assets/json/eval.json');
        let json = await response.json();
        console.log(json);
        this.listEmployer = json;
        console.log(this.listEmployer);
    }
}

Vue.createApp(monApp).mount('#app');