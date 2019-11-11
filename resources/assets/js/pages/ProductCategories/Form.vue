<template>
    <admin-content :title="$route.params.id ? 'Editar Categoria' : 'Criar Categoria'">

        <div class="columns">
            <div class="column is-8">
                <form class='box' @submit.prevent="submit">
                    <b-field label="Nome">
                        <b-input v-model="product_category.name"></b-input>
                    </b-field>
                    <div class="has-text-right">
                        <b-button native-type='submit' :loading="loading" type="is-primary">Salvar</b-button>
                    </div>
                </form>
            </div>
            <div class="column">
                <div class="box center-xs">
                    <b-field label="Imagem">
                        <b-upload accept="image/*" v-model="image" @input="selectImage()">
                            <b-button class="full-width" :loading="uploading" tag="a">
                                <b-icon icon="upload" size="is-small"></b-icon>
                                <span>Selecionar imagem...</span>
                            </b-button>
                        </b-upload>
                    </b-field>
                    <bg-image :src="previewImageUrl" v-if="previewImageUrl" height="200px">
                        <div v-if="image">
                            (Pré-Visualização) 
                        </div>
                    </bg-image> 
                </div>
            </div>
        </div>
    </admin-content>
</template>


<script>

import api from "../../services/api";

import BgImage from "../../components/BgImage";

export default {

    name: 'product-category-form',

    components: { BgImage },

    data() {
        return {
            product_category: {name: ''},
            image: null,
            previewImageUrl: null,
            uploading: false,
            loading: false,
        }
    },

    async created() {

        const {id} = this.$route.params;

        if (! id) return;

        const {data: product_category} = await api.get(`product-categories/${id}`);

        this.product_category = product_category;

        this.previewImageUrl = this.product_category.url_image;

    },


    methods: {

        async selectImage() {

            this.previewImageUrl = URL.createObjectURL(this.image)

            if (!this.product_category.id) return;
            
            await this.upload();

            this.$buefy.toast.open({
                message: "Imagem enviada com sucesso!",
                type: "is-primary",
                position: "is-bottom-right"
            });
        },

        async upload()
        {
            const data = new FormData;

            data.append('image', this.image);

            this.uploading = true;
            
            try {
                await api.post(`product-categories/${this.product_category.id}/upload-image`, data);
            } finally {
                this.uploading = false;
            }

            this.image = null;
        },

        async save() {

            
            if (this.product_category.id) {
                return await api.put(`product-categories/${this.product_category.id}`, this.product_category);
            }
            
            const result = await api.post('product-categories', this.product_category);

            this.product_category = result.data;

            return result;
        },

        async submit() {

            this.loading = true;

            try{
                await this.save();
            } finally{
                this.loading = false;
            }
            
            this.image && await this.upload();

            this.$buefy.toast.open({
                message: "Categoria salva com sucesso!",
                type: "is-primary",
                position: "is-bottom-right"
            });

            this.$router.push({
                name: 'product_categories',
            })
        }
    }
}
</script>