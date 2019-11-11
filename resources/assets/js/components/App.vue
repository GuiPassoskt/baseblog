<template>
    <transition name="fade">
        <router-view></router-view>
    </transition>
</template>
<script>

import api from "../services/api"

export default {

    created() {

        api.interceptors.response.use(undefined, (err) => {

            if (! err.response) return Promise.reject(err);

            const {data, status} = err.response;

            if (status == 401) {
                window.localStorage.removeItem('api_token');
                this.$router.replace({name: 'login'});
            }

            else if (status === 422) {
                
                const message = Object.values(data)[0][0];

                this.$buefy.toast.open({
                    message,
                    type: "is-warning",
                    position: "is-bottom-right",
                    duration: 5000
                });
            }

            else if (status >= 400 && status < 500) {

                this.$buefy.toast.open({
                    message: "Ops! Parece que algo deu errado!",
                    type: "is-primary",
                    position: "is-bottom-right",
                    duration: 5000
                });
            }

            else if (status >= 500) {

                this.$buefy.toast.open({
                    message: "Ocorreu um erro interno.<br/> Tente novamente<br>ou entre em contato com o desenvolvedor",
                    type: "is-danger",
                    position: "is-bottom-right",
                    duration: 5000
                });
            }

            return Promise.reject(err);
        })
    }
}
</script>