<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 bg-dark">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body" v-if="this.$store.state.loadAssets.cats == 1 && this.$store.state.loadAssets.post == 1">

                        <cover></cover>

                        <post></post>

                        <hr>

                        <images></images>

                        <hr>

                        <button @click="formSubmit" class="btn btn-success btn-block">Salvar</button>

                    </div>
                    <div v-else class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PostManager",
        props: {
            pid: {
                type: Number,
            },
        },
        mounted() {
            console.log('Component mounted.')
        },
        created: function(){

            console.log("PID");

            console.log(this.pid);

            this.initAssets();

        },
        methods: {
            initAssets: function(){
                this.$store.dispatch("setthePostId", this.pid).then(() => {
                    this.$store.dispatch("getPost");
                    this.$store.dispatch('getEditorCats');
                });
            },
            saveIt(){

                this.$store.dispatch('save');

            },
            formSubmit(e){
                if(e){
                    e.preventDefault();
                }

                let self = this;
                this.$swal
                .fire({
                    title: "Salvar Produto?",
                    showCancelButton: true,
                    confirmButtonColor: "#84b77c",
                    confirmButtonText: "Sim",
                    cancelButtonText: "Não",
                    showLoaderOnConfirm: true,
                    preConfirm: () => {

                       return axios.post("/editor/post/save", {
                                post: this.$store.state.post,
                            })
                            .then(response => {
                                if (response.status != 200) {
                                    return new Error("Something went wrong");
                                }

                                if (response.data.status != true) {
                                    return response.data;
                                }

                                // dispatch('saveImages');
                                // dispatch('saveCover');

                                this.saveCover(response.data.product_id);
                                // this.saveImages();

                                return response.data;

                            })
                            .catch(function(error) {
                                return 401;
                            });

                    },
                    allowOutsideClick: () => !this.$swal.isLoading()
                })
                .then(result => {
                    console.log("resultresultresultresultresultresultresultresultresultresultresultresultresultresultresultresult");
                    console.log(result.value);
                    if (
                    result.value === 401 ||
                    result.value == 401 ||
                    result.value === "401"
                    ) {
                    this.$swal.fire({
                        icon: "error",
                        title: "Oops...",
                        html: "Usuário não autorizado 🧐",
                        text: "Alguma coisa deu errado!",
                        timer: 4000,
                        timerProgressBar: true,
                        showCancelButton: false, // There won't be any cancel button
                        showConfirmButton: false
                    });
                    } else {
                    if (result.value.status != true && result.value != 401) {
                        this.$swal.fire({
                        icon: "error",
                        title: "Oops...",
                        html:
                            '<i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;<b>' +
                            result +
                            "</b>",
                        text: "Alguma coisa deu errado!",
                        timer: 4000,
                        timerProgressBar: true,
                        showCancelButton: false, // There won't be any cancel button
                        showConfirmButton: false
                        });
                    } else {

                        this.$swal
                        .fire({
                            icon: "success",
                            title: "",
                            text: "Produto Salvo!",
                            timer: 2000,
                            focusConfirm: false,
                            timerProgressBar: true,
                            showCancelButton: false, // There won't be any cancel button
                            showConfirmButton: false // There won't be any confirm button
                        })
                        .then(function() {
                            console.log('ok');
                        });
                    }
                    }
                })
                .catch(function(error) {
                    console.log('error');
                    console.log(error);
                });
            },
            saveCover(pid){

                const config = {
                    headers: { "content-type": "multipart/form-data" },
                };
                const data = new FormData();
                data.append('cover', this.$store.state.cover.data);
                const json = JSON.stringify({
                    productId: pid
                });

                data.append('data', json);

                axios.post("/editor/post-cover/save", data, config)
                    .then(response => {

                        if (response.status != 200) {
                            return new Error("Something went wrong");
                        }

                        if(response.data.status == true){
                            return true;
                        }

                    })
                    .catch(function(error) {
                        return false;
                    });

            },
            saveImages(){

                console.log("setImages");

                const formData = new FormData();

                let files = this.$store.state.images;

                files.forEach(file => {
                    formData.append('images[]', file, file.name);
                });

                axios.post('/editor/post-images/save', formData)
                    .then(response => {
                        console.log(response);
                    }).catch(function(error) {
                        console.log(error);
                        return false;
                        });

            },
        }
    }
</script>
