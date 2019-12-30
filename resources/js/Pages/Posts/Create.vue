<template>
<layout>
    <div>    
        <InertiaLink href="/posts" class="nav-link">
                        Back
                    </InertiaLink>      
        <form @submit.prevent="submit">
            <div class="form-group">
                <label for="post_name">Post Name</label>
                <input 
                type="text" 
                :class="setClassBasedOnState('post_name')"
                id="post_name"  
                placeholder="Post Name" 
                name="post_name" 
                v-model="form.post_name">
                <div v-if="$page.errors.post_name" class="invalid-feedback">
                    {{$page.errors.post_name[0]}}
                </div>
            </div>

            <div class="form-group">
                <label for="post_description">Post Description</label>
                <textarea 
                :class="setClassBasedOnState('post_description')"
                id="post_description" 
                placeholder="Post Description" 
                name="post_description" 
                v-model="form.post_description">
                
                </textarea>

                <div v-if="$page.errors.post_description" class="invalid-feedback">
                    {{$page.errors.post_description[0]}}
                </div>
            </div>

            <button class="btn btn-primary" type="submit" :disabled="sending">
                <span v-if="sending" class="spinner-border spinner-border-sm text-warning" role="status" aria-hidden="true"></span>
                {{saveButton}}
            </button>
        </form>
    </div>
    </layout>
</template>

<script>

export default {
    computed: {
        saveButton : function(){
            if(this.sending === true){
                return 'Saving...';
            }else{
                return 'Save';
            }
        },
    },
    
    data : function(){
        return {
            sending: false,
            form: {
                post_name: null,
                post_description: null,
            }
        };
    },
    methods : {
        submit : function(){
            this.sending = true
            this.$inertia.post('/posts/', this.form)
            .then(() => this.sending = false);
        },
        setClassBasedOnState : function(formAttributes){

            if(this.$page.errors[formAttributes]){
                return 'form-control is-invalid';
            }else{
               return 'form-control'; 
            }
        },  
        
    },
}
</script>