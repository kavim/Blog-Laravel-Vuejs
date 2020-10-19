<template>
    <div class="row my-4">

        <!-- {{ this.post }} -->

        <div style="width: 110px" class="d-flex justify-content-between">
            <span class="pt-1">publicar:</span>
            <div class="toggle lg">
                <label>
                    <input type="checkbox" v-model="post.active" value="1">
                    <span class="button-indecator"></span>
                </label>
            </div>
        </div>

        <div class="col-12">

            <div class="form-group">
                <label for="Titulo">Titulo</label>
                <input v-model="post.title" type="text" class="form-control" id="Titulo" placeholder="Titulo">
            </div>
            <div class="form-group">
                <!-- <label for="content">content</label>
                <input v-model="post.content" type="text" class="form-control" id="content" placeholder="content"> -->

                <label for="desc" class="m-2">content: </label>
                <ckeditor :editor="editor" v-model="post.content" :config="editorConfig" :maxlength="290"></ckeditor>
            </div>

        </div>

        <div class="col-12">
            <!-- {{ cats }} -->

            <hr>

            <label for="category_id" class="m-2"> Categoria: </label>
            <select v-model="selectedCat" class="form-control">
                <option disabled value="0">Categoria</option>
                <option v-for="option in categoriesAs" v-bind:value="option.value" :key="option.value">
                    {{ option.text }}
                </option>
            </select>
        </div>

        <div class="col-12">
            <!-- <hr>
            Vincular video.
            <div class="form-group">
                <label for="videoToAddtitle">titulo</label>
                <input v-model="videoToAdd.title" type="text" class="form-control" id="videoToAddtitle">
            </div>
            <div class="form-group">
                <label for="videoToAdd">link</label>
                <input v-model="videoToAdd.link" type="text" class="form-control" id="videoToAdd">
            </div> -->

            <!-- <form class="form-inline">
                <div class="form-group mb-2">
                    <label for="videoToAdd" class="sr-only">Password</label>
                    <input v-model="videoToAdd.link" type="text" class="form-control" id="videoToAdd">
                </div>

                <button @click="addVideo()" type="button" class="btn btn-primary">ADD</button>
            </form> -->

            <hr>
            Vincular video, cole o link do youtube aqui

            <div class="input-group mb-3">
                <label for="videoToAdd" class="sr-only">Password</label>
                <input v-model="videoToAdd.link" type="text" class="form-control col-12" id="videoToAdd" aria-label="Recipient's videoToAdd" aria-describedby="basic-videoToAdd" placeholder="ex: https://youtu.be/H5CJpZGlmFU?list=RDCUdw-urZ3zg">

                <div class="input-group-append">
                    <button @click="addVideo()" type="button" class="btn btn-outline-primary" :disabled="addVideoIsDisabled">Adicionar</button>
                </div>
            </div>
            <div v-for="(video, index) in videos" :key="index">
                <!-- {{ video }} -->
                <div class="card" style="width: 100%">

                    <div v-html="embData(video.link)"></div>

                <div class="card-body">
                    <button @click="removeVideo(video)" class="btn btn-danger">Remover</button>
                </div>
                </div>
            </div>

        </div>



    </div>
</template>

<script>
    import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
    export default {
        data() {
            return {
                post: this.$store.state.post,
                videoToAdd: {
                    title: '',
                    link: ''
                },
                videos: this.$store.state.videos,
                editor: ClassicEditor,
                editorData: "",
                editorConfig: {
                    // The configuration of the editor.
                    toolbar: {
                    items: [
                        "bold",
                        "italic",
                        "undo",
                        "redo",
                        "NumberedList",
                        "BulletedList",
                    ],
                    },
                },
                cats: this.$store.state.cats,
                selectedCat: 0
            }
        },
        methods: {
            syncdata() {
                this.$store.dispatch("setPost", this.post);
            },
            syncVideos() {
                this.$store.dispatch("setVideos", this.videos);
            },
            addVideo(){
                this.videos.push(
                    {
                        title: this.videoToAdd.title,
                        link: this.videoToAdd.link
                    }
                );

                this.videoToAdd = {
                    title: '',
                    link: ''
                }
            },
            removeVideo(obj){
                const index = this.videos.indexOf(obj);

                if (index > -1) {
                    this.videos.splice(index, 1);
                }
            },
            embData(url){

                function getId(val) {
                    var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                    var match = url.match(regExp);

                    if (match && match[2].length == 11) {
                        return match[2];
                    } else {
                        return 'error';
                    }
                }

                let retorno = '';

                if(url === " " || url === ""){
                    console.log(url);

                    retorno = '';
                }else{
                    let vid = getId(url);

                    if(vid != 'error'){
                        retorno = '<iframe width="100%" height="315" src="https://www.youtube.com/embed/' + vid + '" frameborder="0" allowfullscreen></iframe>'
                    }else{
                        retorno = '';
                    }
                }

                return retorno;
            },
            syncCategory(){
                this.post.category_id = this.selectedCat;
            }
        },
        watch: {
            post: {
                handler: function(val) {
                    this.syncdata();
                },
                deep: true
            },
            videos: {
                handler: function(val) {
                    this.syncVideos();
                },
                deep: true
            },
            selectedCat: function(val){
                this.syncCategory();
            }
        },
        computed: {
            addVideoIsDisabled(){

                if(this.videoToAdd.link != '' && this.videoToAdd.link != ' '){
                    return false;
                }

                return true;
            },
            categoriesAs: function(){

                let retorno = [];
                this.$store.state.cats.forEach(cat => {
                    if(this.post.category_id == cat.id){
                        this.selectedCat = cat.id;
                    }

                    retorno.push({ text: cat.name, value: cat.id });
                });

                if(this.post.category_id == null || this.post.category_id == 0){
                    this.selectedCat = 0;
                }

                return retorno;
            },
        }
    }
</script>
