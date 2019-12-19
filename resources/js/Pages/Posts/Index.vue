<template>
<layout>

    <div>
    <div class="row mb-4">
        <div class="col form-inline">
            Per Page: &nbsp;
            <select class="form-control" v-model="perPageLength">
                <option v-for="eachPageLength in paginationLengthArray" v-bind:key="eachPageLength" :value="eachPageLength">{{eachPageLength}}</option>
            </select>
        </div>

        <div class="col">
            <TextField 
              type="search"
              placeholder="Search By Post Name or Slug or Description..." 
              class="mb-1 text-xl" 
              v-model="globalSearch" />
        </div>
    </div>

    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>
                        Post Name	
                    </th>
                    <th>
                        Post Slug
                    </th>
                    <th>
                        Post Desc
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="post in posts.data" v-bind:key="post.id">
                    <td>{{post.post_name}}</td>
                    <td>{{post.post_slug}}</td>
                    <td>{{post.post_description}}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="col">
            <links
            :urlsArray="paginatedLinks"
            :previousPageUrl="previousPageUrl"
            :nextPageUrl="nextPageUrl"
            >
            </links>
        </div>
        <div class="col text-right text-muted">
            Showing {{ firstItem }} to {{ lastItem }} out of {{ totalItems }} results
        </div>
    </div>
</div>
    
</layout>
</template>


<script>

import { stringify } from 'qs';
import debounce from 'lodash/debounce';

export default {
    components : {

    },
    props : {
        posts : {
            type : Object,
            default : null,
        },
        paginatedLinks : {
            type : Array,
            default : null,
        },
        postNameSearch : {
            type : String,
            default : null,
        },
        postDescriptionSearch : {
            type : String,
            default : null,
        },
        paginationLength : {
            type : String,
            default : null,
        },
        paginationLengthArray: {
            type : Array,
            default : [],
        },
        globalSearchSearch : {
            type : String,
            default : null,
        },
    },

    data : function(){ 
            return {
                postName : this.postNameSearch,
                postDescription : this.postDescriptionSearch,  
                perPageLength : this.paginationLength,
                globalSearch : this.globalSearchSearch,
            };
    },
    computed : {
        nextPageUrl : function(){
            return this.posts.next_page_url;
        },
        previousPageUrl : function(){
            return this.posts.prev_page_url;
        },
        urlQueryWithParms : function(){
            let x = stringify({
                postName: this.postName || undefined,
                postDescription: this.postDescription || undefined,
                perPageLength: this.perPageLength || undefined,
                globalSearch: this.globalSearch || undefined,
                
            });

            return x;
        },
        totalItems : function(){
            return this.posts.total;
        },
        firstItem : function(){
            return this.posts.from;
        },
        lastItem : function(){
            return this.posts.to;
        },
    },
    watch : {
        postName : debounce(function(){

            const query = this.urlQueryWithParms;

            this.$inertia.visit(query ? `/posts?${query}` : '/posts', {
                preserveScroll: true,
                preserveState: true,
                only: ['posts','paginatedLinks'],
            });
        },300),

        postDescription : debounce(function(){

            const query = this.urlQueryWithParms;

            this.$inertia.visit(query ? `/posts?${query}` : '/posts', {
                preserveScroll: true,
                preserveState: true,
                only: ['posts','paginatedLinks'],
            });
        },300),  

        perPageLength : debounce(function(){

            const query = this.urlQueryWithParms;

            this.$inertia.visit(query ? `/posts?${query}` : '/posts', {
                preserveScroll: true,
                preserveState: true,
                only: ['posts','paginatedLinks'],
            });
        },300), 

        globalSearch : debounce(function(){

            const query = this.urlQueryWithParms;

            this.$inertia.visit(query ? `/posts?${query}` : '/posts', {
                preserveScroll: true,
                preserveState: true,
                only: ['posts','paginatedLinks'],
            });
        },300), 

        
        
        
    }
}
</script>