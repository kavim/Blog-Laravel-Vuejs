<template>
    <div class="container">
        {{ this.post }}
        <hr>
        {{ this.cover }}
        <hr>
        {{ this.images }}

        <br>
        <hr>

        <img width="300" :src="cover" alt="">

        <h1>
            {{ post.title }}
        </h1>

        <h2>
            {{ post.subtitle }}
        </h2>

        <p v-html="post.content"></p>

        <hr>

        <div class="m-2" v-for="(image, index) in images" :key="index">
            <img :src="image.src" alt="" width="100">
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loadingPost: true,
            post: [],
            cover: [],
            images: []
        }
    },
    created: function() {

        console.log(this.$route.params.id);

        this.getPost();
    },
    methods:{
        getPost(){
            axios
            .get("/api/get-post/"+this.$route.params.id)
            .then(response => {
                console.log(response.data);
                this.post = response.data.post;
                this.cover = response.data.cover.src;
                this.images = response.data.images.images;

                this.loadingPost = false;
            })
            .catch(error => {
                console.log("tuve un error");
            });
        }
    }
}
</script>
