<template>
    <admin-content :title="post.id ? 'Editar Publicação' : 'Criar Publicação'">
        <form class="block" @submit.prevent="save">
            <div class="row">
                <div class="col-xs-12 col-md-8">
                    <div class="box">
                        <b-field label="Título">
                            <b-input type="text" v-model="post.title" required maxlength="255" />
                        </b-field>

                        <b-field>
                            <quill-editor ref="editor" :options="quillOptions" v-model="post.content" />
                        </b-field>

                        <div class="has-text-right">
                            <b-button native-type='submit' :loading="loading" type="is-primary">Salvar</b-button>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <b-field label="Descrição">
                            <b-input 
                                placeholder='Insira uma descrição para otimizar a busca do seu site nos mecanismos de pesquisa' 
                                required 
                                type="textarea" 
                                v-model="post.excerpt" 
                                rows="3" 
                                minlength="60"
                                maxlength="400"
                            />
                        </b-field>

                        <b-field label="Palavras-Chaves">
                            <b-taginput v-model="post.meta_keywords" placeholder="Palavras chaves separadas por vírgulas" />
                        </b-field>

                        <b-field label="Slug">
                            <b-input required v-model="post.slug" @input="(value) => post.slug = slugify(value)" placeholder="titulo-da-pagina"></b-input>
                        </b-field>
                    </div>

                    <div class="box center-xs">
                        <b-field label="Imagem Principal">
                            <b-upload accept="image/*" v-model="selectedFile" @input="previewImage()">
                                <a class="button is-full-width">
                                    <b-icon icon="upload" size="is-small"></b-icon>
                                    <span>Selecionar imagem...</span>
                                </a>
                            </b-upload>
                        </b-field>
                        <bg-image :src="blobImageUrl" v-if="blobImageUrl" >
                            <div>(Pré-Visualização)</div>
                        </bg-image> 
                    </div>
                </div>
            </div>
        </form>

         <b-modal :active.sync="isModalOpen" :width="800" scroll="keep">
            <div class="box">
                <h4 class="title is-6">Imagens</h4>
                <file-manager 
                    @back="(path) => loadFiles(path)"
                    :files.sync="files" 
                    :currentPath="currentPath"
                    @selectImage="({file}) => insertImage(file)"
                    @selectDir="(path) => loadFiles(path)" /> 
            </div>
        </b-modal>
    </admin-content>
</template>


<script>

import "quill/dist/quill.core.css";
import "quill/dist/quill.snow.css";
import "quill/dist/quill.bubble.css";

import api from "../../services/api";

import BgImage from "../../components/BgImage";
import FileManager from "../../components/FileManager"
import { quillEditor, Quill } from "vue-quill-editor";

import slugify from "slugify"

export default {
    components: { quillEditor, FileManager, BgImage },

    created() {
        this.loadInfo();
    },

    computed: {
        quill() {
            return this.$refs.editor.quill
        },
        labels() {
            return {
                title: "Título",
                subtitle: "Subtítulo",
                text: "Texto",
                list: "Lista"
            };
        },

        quillOptions() {

            const handlers = {
                image: this.imageHandler,
            };

            const toolbar = [
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['image']
            ];

            const clipboard = {
                matchVisual: false
            };


            return { 
                modules: { 
                    toolbar: {
                        container: toolbar,
                        handlers 
                    },
                    clipboard, 
                } 
            };
        }
    },

    data() {
        return {
            activeTab: 0,
            blobImageUrl: null,
            files: [],
            currentPath: null,
            isModalOpen: false,
            lastQuillRange: null,
            loading: false,
            post: {},
            selectedFile: null,
        };
    },

    methods: {
        imageHandler() {
            this.lastQuillRange = this.quill.getSelection();
            this.openFileManager()
        },
        insertImage(file) {
                this.quill.insertEmbed(this.lastQuillRange.index, 'image', file.url, Quill.sources.USER);
                this.isModalOpen = false;
        },
        async openFileManager()
        {
            this.isModalOpen = true;    
            this.loadFiles()
        },

        async loadFiles(path) {

            const params = {path}

            const {data: {files, relative_path}} = await api.get('files', {params});

            this.files = files;
            this.currentFolder = relative_path;

        },
        async loadInfo() {

            if (! this.$route.params.id) return; 

            const { data: post } = await api.get(`posts/${this.$route.params.id}`);
            this.post = { 
                ...post, meta_keywords: (post.meta_keywords || "").split(",") 
            };

            this.blobImageUrl = this.post.url_cover_image
            
        },

        async save() {
            
            let result;

            const post = {
                ...this.post,
                meta_keywords: (this.post.meta_keywords || []).join(",")
            };

            if (this.post.id) {

                result = await api.put(`posts/${this.post.id}`, post);

            } else {

                const {data: result} = await api.post('posts', post);

                this.post.id = result.id;
            }

            this.selectedFile && await this.uploadImage();

            this.$buefy.toast.open({
                message: "Publicação salva com sucesso!",
                type: "is-primary",
                position: "is-bottom-right"
            });

            this.$router.push({
                name: "posts",
            });
        },

        async uploadImage() {

            const form = new FormData();

            form.append("cover_image", this.selectedFile, this.selectedFile.name);

            const {data: {cover_image}} = await api.post(`posts/${this.post.id}/upload-cover-image`, form);

            this.post.cover_image = cover_image;

            this.selectedFile = null;
        },

        previewImage()
        {
            if (this.blobImageUrl) URL.revokeObjectURL(this.blobImageUrl);

            this.blobImageUrl = window.URL.createObjectURL(this.selectedFile);
        },
        
        slugify(value) {
            return slugify(value, {
                replacement: '-',    // replace spaces with replacement
                remove: null,        // regex to remove characters
                lower: true          // result in lower case
            })
        }

        
    },

    watch: {
        "post.title"() {

            if (this.post.id) return;

            this.post.slug = this.slugify(this.post.title);
        }
    }
};
</script>


<style>
.ql-editor {
    min-height: 300px;
    max-height: 600px;
    overflow: auto;
}
</style>