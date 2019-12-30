<template>
    <layout>
        <div class="card-block">
    <div class="card">
        <div class="card-header">
            Show Post Details

            <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                    <InertiaLink href="/posts" class="nav-link">
                        Back
                    </InertiaLink>
                    <InertiaLink 
                    :href="post.url.editAction" class="nav-link">
                        Edit
                    </InertiaLink>
                </li>
            </ul>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>Post Name</th>
                        <td>{{post.post_name}}</td>
                    </tr>
                    <tr>
                        <th>Post Slug</th>
                        <td>{{post.post_slug}}</td>
                    </tr>
                    <tr>
                        <th>Post Description</th>
                        <td>{{post.post_description}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    </layout>
</template>

<script>
export default {
    
    props : {
        post : {
            type : Object,
            required : true,
        },
    },
}
</script>