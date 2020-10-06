<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body" v-if="this.$store.state.loadAssets.cats == 1">

                        <cover></cover>

                        <post></post>

                        <hr>

                        <images></images>

                        <hr>

                        <button @click="saveIt" class="btn btn-success btn-block">Salvar</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        created: function(){

            this.initAssets();

        },
        methods: {
            initAssets: function(){
                this.$store.dispatch("setthePostId", this.pid).then(() => {
                    // this.$store.dispatch("getProduct");
                    this.$store.dispatch('getEditorCats');
                });
            },
            saveIt(){

                console.log("click");

                this.$store.dispatch('save');
            }
        }
    }
</script>
