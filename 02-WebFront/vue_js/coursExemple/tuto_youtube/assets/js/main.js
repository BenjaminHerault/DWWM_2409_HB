const vm = Vue.createApp({
    data(){
        return{
            todos: ["Sauver le monde", "Apprendre Vue JS", "Boire un café"]
        }
    },
    methods:{
        inverser(){
            this.todos.reverse();
        },
        ajouterNoter(message){
            this.todos.push(message);
        }
    }
})

vm.component('note',{
    props:['content'],
    template: `<p>{{ content }} </p>`
});


vm.component('ajout', {
    props:[],
    emits: ['nouvellenote'],
    data(){
        return{
            interne: 'Nouveau message'
        }
    }
    ,
    methods:{
        enregistrementNote(){
            this.$emit('nouvellenote', this.interne)
            this.interne = '';
        }
    },
    template: `
        <input type="text" v-model="interne" />
        <a href="#" v-on:click="enregistrementNote" v-if="interne !=''">Ajouter</a>
        {{interne}}
    `
});

vm.mount('#app');