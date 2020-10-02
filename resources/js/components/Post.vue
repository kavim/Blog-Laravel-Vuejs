<template>
    <div class="row">

        {{ this.post }}

        <form>
        <div class="form-group">
            <label for="Titulo">Titulo</label>
            <input v-model="post.title" type="text" class="form-control" id="Titulo" placeholder="Titulo">
        </div>
        <div class="form-group">
            <label for="content">content</label>
            <input v-model="post.content" type="text" class="form-control" id="content" placeholder="content">
        </div>
        </form>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                post: this.$store.state.post
            }
        },
        methods: {
            syncdata() {
                this.$store.dispatch("setPost", this.post);
            },
        },
        watch: {
            post: {
                handler: function(val) {
                    this.syncdata();
                },
                deep: true
            }
        }
    }
</script>
