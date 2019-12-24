<template>
    <button 
        class="btn btn-sm btn-outline-danger" 
        type="button" 
        @click="deleteModel"
    >
    Delete
    </button>
</template>

<script>
export default {
    props : {
        url : {
            type : String,
            required: true,
            default : null
        },
        confirmDialog : {
            type : String,
            default : 'Are You Sure',
        },
    },

     methods : {
        deleteModel : function(){
            if (confirm(this.confirmDialog)) {
                this.$inertia.delete(this.url);
            }
        },
    },
}
</script>