<template>
    <div >
        <strong>Imagens do post</strong>
        <div class="uploader">
            <div class="images-preview" v-show="theImagens.length">
                <div class="img-wrapper" v-for="(image, index) in theImagens" :key="index">
                    <img :src="image.src" :alt="`Image Uplaoder ${index}`">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" :id="'c'+index" v-model="toDelete" :value="image.id">
                            <label class="form-check-label" :for="'c'+index">Marque para deletar</label>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            theImagens: [],
            toDelete: []
        }
    },
    created: function(){
        this.loadImages();
    },
    methods: {
        loadImages(){

            this.theImagens = this.$store.state.prevImages;

        },
        syncData(){
            console.log("syncdata syncdata syncdata syncdata ")
            this.$store.dispatch("setImagesToDelete", this.toDelete);
        }
    },
    watch: {
        toDelete: {
            handler: function(val) {
                this.syncData();
            },
            deep: true
        },
    }

}
</script>


<style lang="scss" scoped>



.uploader {
    width: 100%;
    background: #ffffff;
    color: #fff;
    text-align: center;
    border-radius: 10px;
    border: 3px dashed #fff;
    font-size: 20px;
    position: relative;

    i {
        font-size: 85px;
    }

    .images-preview {
        display: flex;
        flex-wrap: wrap;
        margin-top: 20px;

        .img-wrapper {
            width: 160px;
            display: flex;
            flex-direction: column;
            margin: 10px;
            height: 150px;
            justify-content: space-between;
            background: #fff;
            box-shadow: 5px 5px 20px #e9e9e9;
            font-size: 15px;
            color: #000;

            img {
                max-height: 105px;
            }
        }

        .details {
            font-size: 12px;
            background: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: self-start;
            padding: 3px 6px;

            .name {
                overflow: hidden;
                height: 18px;
            }
        }
    }

    .upload-control {
        position: absolute;
        width: 100%;
        background: #fff;
        top: 0;
        left: 0;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        padding: 10px;
        padding-bottom: 4px;
        text-align: right;

        button, label {
            background: #477295;
            border: 2px solid #03A9F4;
            border-radius: 3px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
        }

        label {
            padding: 2px 5px;
            margin-right: 10px;
        }
    }
}
</style>
