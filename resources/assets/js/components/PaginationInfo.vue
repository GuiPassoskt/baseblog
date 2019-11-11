<template>
    <div :closable="false" class='box' v-if="value && value.total > 0">
        <div class="columns">
            <div class="column">
                Exibindo {{ value.data.length }} de {{ value.total }} {{ label }}
            </div>
            <div class="column has-text-right">
                Página {{ value.current_page}} de {{ value.last_page }}
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'pagination-info',
    props: {
        value: Object,
        label: {
            type: String,
            default: 'Itens'
        }
    }
}
</script>