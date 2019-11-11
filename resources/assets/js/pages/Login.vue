<template>

    <div id="login-container">
        <form id="login-box"  @submit.prevent="login">
                <b-notification :active.sync="error" type="is-danger">
                    {{ error }}
                </b-notification>

            <div class="box">
                <h2 class="title is-6"> Seja bem-vindo à área de administração</h2>
                
                <b-field label="E-mail">
                    <b-input required type="email" v-model="user.email"></b-input>
                </b-field>
                <b-field label="Senha" >
                    <b-input v-model="user.password" required type="password" ></b-input>
                </b-field>
                <div class="has-text-right">
                    <b-button native-type="submit" :loading="loading" type="is-primary">Entrar</b-button>
                </div>
            </div>
        </form>
    </div>
    
</template>


<script>

import api from "../services/api";

export default {
    
    name: 'login',

    created() {

        const token = window.localStorage.getItem('api_token');

        token && this.$router.push({name: 'products'})
    },

    data() {
        return {
            error: null,
            loading: false,
            user: {email: null, password: null}
        }
    },
    
    methods: {
        async login() {

            this.error = null;
            this.loading = true;

            try{

                let {data: result} = await api.post('users/login', this.user);
            
                if (result.error) {
                    this.error = result.error;
                    return;
                }

                window.localStorage.setItem('api_token', result.api_token);

                return this.$router.push({name: 'products'})

            } finally {
                this.loading = false;    
            }
        }
    }
}
</script>



<style scoped>
#login-container{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background-color: #f1f1f1;
    min-height: 100vh;
}
#login-box{
    margin: 0  auto;
    width: 500px;
    max-width: 98%;
}
</style>
