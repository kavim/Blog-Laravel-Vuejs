import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import { startCase } from 'lodash';
Vue.use(Vuex)

let post = window.localStorage.getItem('post');
let cover = window.localStorage.getItem('cover');
let images = window.localStorage.getItem('images');
let cats = window.localStorage.getItem('cats');
let thePostId = window.localStorage.getItem('thePostId');

export default new Vuex.Store({
    state: {
        thePostId: 0,
        post: post ? JSON.parse(post) : {
          id: 0,
          title: 'novo',
          subtitle: 'subtitle',
          description: 'description',
          content: 'content',
          active: 'active',
          block: 0,
          category_id: 0
      },
      cover: cover ? JSON.parse(cover) : {
        src: '/image/default-cover.png',
        data: ''
      },
      images: images ? JSON.parse(images) : [],
      cats: cats ? JSON.parse(cats) : [],
      loadAssets:{
          post: 0,
          cats: 0,
      }
    },
    getters: {

    },
    mutations:{
      store_setPost(state, post){
        state.post = post;
      },
      store_setCover(state, cover){
        state.cover = cover;
        // window.localStorage.setItem('cover', JSON.stringify(state.cover));
      },
      store_setImages(state, images){
        state.images = images;
      },
      store_cats(state, cats){
        state.cats = cats;
      },
      store_post(state, post){
        state.post = post;
        state.loadAssets.post = 1;
      },
    },
    actions: {
      async setthePostId({commit}, thePostId){

        console.log("setthePostId");
        console.log(thePostId);
        this.state.thePostId = thePostId;
      },
      getPost({ commit, dispatch  }) {
            if(this.state.thePostId != null && this.state.thePostId != 0 && this.state.thePostId != 'init'){
                axios.get('/editor/get-post-by-id/'+this.state.thePostId)
                .then(function (response) {

                    console.log(response);

                    commit('store_post', response.data);

                    // this.state.post = response.data;

                    // this.state.loadAssets.post = 1;

                })
                .catch(function (error) {
                    console.log(error);
                    console.log("DEU ERRO getPost");
                });
            }else{
                // quando se cria um novo produto
                this.state.loadAssets.post = 1;
            }
      },
      setPost({ commit }, post){
        this.commit('store_setPost', post);
      },
      setCover({ commit }, image){
        this.commit('store_setCover', image);
      },
      setImages({ commit }, images){
        this.commit('store_setImages', images);
      },
      setCategory({ commit }, cat){
        this.commit('store_category', cat);
      },
      getEditorCats({commit }){

        // console.log("getEditorCats");

            axios.get("/editor/get-cats")
            .then(response => {
                if (response.status != 200) {
                    return new Error("Something went wrong");
                }

                // console.log(response.data);

                commit('store_cats', response.data);

                this.state.loadAssets.cats = 1;

            })
            .catch(function(error) {
                return 401;
            });


      },

    },

  })
