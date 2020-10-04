import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

let post = window.localStorage.getItem('post');
let cover = window.localStorage.getItem('cover');
let images = window.localStorage.getItem('images');

export default new Vuex.Store({
    state: {
        post: post ? JSON.parse(post) : {
          title: 'novo',
          subtitle: 'subtitle',
          description: 'description',
          content: 'content',
          active: 'active',
          block: 0,
      },
      cover: cover ? JSON.parse(cover) : {
        src: '/image/default-cover.png',
        data: ''
      },
      images: images ? JSON.parse(images) : [],
    },
    getters: {

    },
    mutations:{
      store_setPost(state, post){
        console.log("store_setPost");

        state.post = post;
      },
      store_setCover(state, cover){
        console.log("store_setCover");

        state.cover = cover;
        // window.localStorage.setItem('cover', JSON.stringify(state.cover));
      },
      store_setImages(state, images){
        console.log("store_setImages");

        console.log(images);

        state.images = images;
      },

    },
    actions: {
      setPost({ commit }, post){
        this.commit('store_setPost', post);
      },
      setCover({ commit }, image){
        this.commit('store_setCover', image);
      },
      setImages({ commit }, images){
        this.commit('store_setImages', images);
      },
      saveCover({ commit }){
        // this.commit('store_setPost', image);
        console.log("setCover");
        console.log(this.state.images);

        const config = {
            headers: { "content-type": "multipart/form-data" },
        };
        const data = new FormData();
        data.append('images', this.state.cover.data);
        const json = JSON.stringify({
            productId: 1
        });

        data.append('data', json);

        axios.post("/editor/post-cover/save", data, config)
        .then(response => {
        console.log(response);

        if (response.status != 200) {
            return new Error("Something went wrong");
        }

        if(response.data.status == true){
            return true;
        }

        console.log("/editor/post-cover/save");

        })
        .catch(function(error) {
        console.log(error);

        return false;
        });

            // axios.post("/editor/post-cover/save", {
            //     cover: this.state.cover,
            // })
            // .then(response => {
            //     if (response.status != 200) {
            //     return new Error("Something went wrong");
            //     }
            //     return response.data;
            // })
            // .catch(function(error) {
            //     return 401;
            // });

      },
      saveImages({ dispatch, commit }){

        console.log("setImages");

        const formData = new FormData();

        let files = this.state.images;

        // this.files.forEach(file => {
        //     formData.append('images[]', file, file.name);
        // });
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

            // axios.post("/editor/post-images/save", {
            //     images: this.state.images,
            // })
            // .then(response => {
            //     if (response.status != 200) {
            //     return new Error("Something went wrong");
            //     }

            //     // dispatch('setCover');

            //     return response.data;
            // })
            // .catch(function(error) {
            //     return 401;
            // });

      },
      save({ dispatch, commit }){

        console.log("save");

            axios.post("/editor/post/save", {post: this.state.post,})
            .then(response => {
                if (response.status != 200) {
                return new Error("Something went wrong");
                }

                dispatch('saveImages');
                dispatch('saveCover');

                return response.data;

            })
            .catch(function(error) {
                return 401;
            });


      },


    },

  })
