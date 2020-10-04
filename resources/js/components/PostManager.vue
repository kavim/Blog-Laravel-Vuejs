<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">

                        <cover></cover>

                        <post></post>

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
        methods: {
            saveIt(){

                console.log("click");

                this.$store.dispatch('save');
            }
        }
    }
</script>
