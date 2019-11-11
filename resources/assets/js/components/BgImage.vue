<template>

    <div>
        <div class="bg-image" :style="{'background-image' : `url(${src})`, height, width}" @click="() => isModalOpen = !!src">
            <div class="image-description">
                <slot ></slot>
            </div>
        </div>
        <b-modal :active.sync="isModalOpen" :width="800" scroll="keep">
            <div class="box">
                <img :src="src" class="modal-image">
            </div>
        </b-modal>
    </div>
</template>

<script>
export default {
    name: 'image-component',
    props: ['src', 'height', 'width'],
    data() {
        return {
            isModalOpen: false,
        }
    }
}
</script>

<style lang='scss' scoped>

.bg-image{
    max-width: 100%;
    width: 100%;
    height: 150px;
    background-position: center;
    background-size: cover;
    border-radius: 4px;
    display: block;
    margin: 0 auto;
    
    .image-description
    {
        transition: all 500ms ease;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f1f1f1;
        cursor: pointer;
        color: #fff;
        background-color: rgba(0, 0, 0, .5);
        height: 100%;
        word-break: break-all;
        font-size: 12px;
        text-align: center;
    }

    &:hover .image-description{
        opacity: 0;
    }
}

.modal-image{
    max-width: 100%;
    margin: 0 auto;
    display: block;
}
</style>

