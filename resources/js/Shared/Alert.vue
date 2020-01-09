<template>
    <div v-show="elementVisible"
        class="alert alert-success alert-dismissible fade show" 
        role="alert">
            {{message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
</template>

<script>
    export default {
        props : {
            timeOut : {
                default : null,
            },
            alertType : {
                type : String,
                default : 'success',
            },
            message : {
                type : String,
                required : true,
            },
        },
        data : function(){ 
                return {
                    elementVisible: true
                }
        },
        created() {
            if(this.timeOut){
                setTimeout(() => this.elementVisible = false, this.timeOut)
            }
        }
    }
</script>