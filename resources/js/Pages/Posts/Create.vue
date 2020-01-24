<template>
<layout>
    <div>  
        <alert 
            v-if="Object.keys($page.errors).length >= 1" 
            alertType="success"
            :message=formErrorMessage
        >
        </alert>


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

            <div class="form-group">
                <label for="user_id">Sample DD</label>
                <select 
                    class="custom-select" 
                    :class="setClassBasedOnState('user_id')" 
                    name="user_id"
                    v-model="form.user_id"
                >
                      <option  :value="null">Open this select menu</option>
                    <option 
                    v-for="(eachUser, userId) in usersList" 
                    :key="userId" :value="userId"
                    >
                        {{eachUser}}
                    </option>
                </select>
                <div v-if="$page.errors.user_id" class="invalid-feedback">
                    {{$page.errors.user_id[0]}}
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
    props : {
        usersList : {
            type : Object,
            default : {},
        },
    },
    computed: {
        saveButton : function(){
            if(this.sending === true){
                return 'Saving...';
            }else{
                return 'Save';
            }
        },
        formErrorMessage : function(){
            return 'There are ' + Object.keys(this.$page.errors).length + ' form errors'
        },
    },
    
    data : function(){
        return {
            sending: false,
            form: {
                post_name: null,
                post_description: null,
                user_id : null,
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

        formUpdated: function(newV, oldV,r) {
    	    console.log('the form object updated')
        }
        
    },
    created: function () {
  	    this.$watch('form', this.formUpdated, {
                deep: true
        })
    },

  

   
}
</script>