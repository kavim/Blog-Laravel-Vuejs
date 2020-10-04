<template>
    <div class="row">

        {{ this.post }}

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
            <hr>
            Vincular video.
            <div class="form-group">
                <label for="videoToAddtitle">titulo</label>
                <input v-model="videoToAdd.title" type="text" class="form-control" id="videoToAddtitle">
            </div>
            <div class="form-group">
                <label for="videoToAdd">link</label>
                <input v-model="videoToAdd.link" type="text" class="form-control" id="videoToAdd">
            </div>

            <button @click="addVideo()" type="button" class="btn btn-success">ADD</button>

            <div v-for="(video, index) in videos" :key="index">
                {{ video }}
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
                videos: [],
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
            }
        },
        methods: {
            syncdata() {
                this.$store.dispatch("setPost", this.post);
            },
            addVideo(){
                this.videos.push(
                    {
                        title: this.videoToAdd.title,
                        link: this.videoToAdd.link
                    }
                );
            }
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
