 <template>
 <div>
   <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end">
         <li class="page-item" v-if="previousPageUrl">
            <InertiaLink 
               :href="previousPageUrl" 
               class="page-link"
               tabindex="-1"
               >
               Previous
            </InertiaLink>
         </li>
         <li 
            class="page-item"
            :class="{ 'active': eachUrlArray.isCurrentPage === true }"
            v-for="eachUrlArray in urlsArray" 
            :key="eachUrlArray.indexKey"
            >
            <span v-if="eachUrlArray.type === 'URLS'">
               <InertiaLink 
                  :href="eachUrlArray.url" 
                  class="page-link" 
                  >
                  {{eachUrlArray.pageNumber}}
               </InertiaLink>
            </span>
            <span v-else-if="eachUrlArray.type === 'ELIPSIS'">
               <a class="page-link" href="#">{{eachUrlArray.url}}</a>
         </span>
         </li>    
         <li class="page-item" v-if="nextPageUrl">
            <InertiaLink 
               :href="nextPageUrl" 
               class="page-link"
               >
               Next
            </InertiaLink>
         </li>
      </ul>
   </nav>
</div>
</template>

  <script>
  export default {
      props : {
         urlsArray : {
            type: Array,
            default : [],
         },
         previousPageUrl: {
            type : String,
            default : null,
         },
         nextPageUrl : {
            type : String,
           default : null,
         }
      }
  }
  </script>