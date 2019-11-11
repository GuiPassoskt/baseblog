<template>
    <admin-content title="Publicações">
        <div>
            <div class="block has-text-right">
                <b-button tag="router-link" type="is-primary" :to="{name: 'post_create'}">criar</b-button>
            </div>

            <pagination-info :value.sync="posts" />

            <b-notification type="is-danger" :closable="false" v-if="posts.total === 0">
                Nenhuma publicação encontrado
            </b-notification>

            <div class="columns is-multiline">
                <div class="column is-12-mobile is-6-tablet is-4-desktop is-3-fullhd" v-for="post in posts.data" :key="post.id">
                    <div class="box post">
                        <bg-image :src="post.url_cover_image" class="block" />
                        <div class="post-body block">
                            <h4>{{ post.title | truncate(50) }}</h4>
                            <div class="is-size-7 post-description">{{ post.excerpt | truncate(100) }}</div>
                        </div>
                        <div class="post-footer">
                            <div class="has-text-right">

                                    
                                <b-button target="_blank" outlined tag="a" icon-left="link" :href="post.url"></b-button>
                                <b-button 
                                    outlined
                                    icon-left="delete"  
                                    type="is-danger"
                                    @click="showRemoveDialog(post, index)" />

                                <b-button 
                                    icon-left="pencil" 
                                    tag="router-link" 
                                    type="is-primary" 
                                    :to="{name: 'post_edit', params: {id: post.id}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <pagination :value.sync="posts" @change="paginate" />
        </div>
    </admin-content>
</template>


<script>

import api from "../../services/api";
import BgImage from "../../components/BgImage";
import Pagination from "../../components/Pagination";
import PaginationInfo from "../../components/PaginationInfo";

export default {

    components: {BgImage, Pagination, PaginationInfo},
    name: 'post-list',

    async created () {
        await this.paginate(1)
    },

    data() {
        return {
            posts: {data:[]}
        }
    },

    methods: {

        async showRemoveDialog(post, index)
        {
            this.$buefy.dialog.confirm({
                message: `Confirma a exclusão da publicação <b>${post.title}</b>?`,
                onConfirm: () => this.remove(post, index),
                confirmText: 'Sim',
                cancelText: 'Não'
            });
        },
        async remove(post, index) 
        {

            this.loading = true;

            try{
                await api.delete(`/posts/${post.id}`);
                this.$buefy.dialog.alert('Publicação removida com sucesso')
                this.paginate(1);
            } finally {
                this.loading = false;
            }
        },

        async paginate(page) {

            this.loading = true;

            const params = {page};

            try{
                const {data: posts} = await api.get('posts', {params})
                this.posts = posts;

            } finally {
                this.loading = false;
            }
    
        }
    },

    computed: {

        columns() {

            return [
                {field: 'name', label: 'Nome'}
            ]
        }
    }
}
</script>




<style scoped lang="scss">

.post{
    height: 100%;
    display: flex;
    flex-direction: column;

    .post-image{
        width: 100%;
        height: 150PX;
        background-position: center;
        background-size: cover;
        border-radius: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f1f1f1;
    }

    .post-body{
        flex: 1;
    }
}

</style>
