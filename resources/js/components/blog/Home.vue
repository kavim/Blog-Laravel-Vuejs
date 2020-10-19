<template>
    <div class="container">
        <div>
            os post
        </div>
        <div v-if="loadingPosts">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
        <div v-else class="row d-flex justify-content-around">
            <div v-for="(post, index) in posts" :key="index" class="card mb-3" style="width: 48%">

                <img src="/image/default-cover.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ post.title }}</h5>
                    <b>{{ post.description }}</b>
                    <p class="card-text" v-html="post.content"></p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loadingPosts: true,
            posts: []
        }
    },
    created: function() {
        console.log('olhaLá');
        this.getPosts();
    },
    methods:{
        getPosts(){
            axios
            .get("/api/get-posts")
            .then(response => {
                console.log(response.data);
                this.posts = response.data;
                this.loadingPosts = false;
            })
            .catch(error => {
                console.log("tuve un error");
            });
        }
    }
}
</script>
