<template>
<body>
        <div class="container pt-4">
<slot>
    
</slot>
        </div>
    </body>
</template>

<script>
export default {
    props: {
        title: {},
        sidebar: { default: true }
    },
    created() {
        document.title = this.title ? `${this.title} | Inertia App` : 'Inertia App';
    }
};
</script>