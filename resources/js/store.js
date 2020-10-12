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
          postcategory: 'postcategory',
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
      store_cats(state, cats){

        console.log(cats);
        state.cats = cats;
      },
      store_post(state, post){

        console.log(cats);
        state.cats = cats;
      },
      store_category(state, cat){
        state.cats = cats;
      },

    },
    actions: {
      async setthePostId({commit}, thePostId){
        this.state.thePostId = thePostId;
      },
      getPost({ commit, dispatch  }) {
            if(this.state.thePostId != null && this.state.thePostId != 0 && this.state.thePostId != 'init'){
                axios.get('/editor/get-post/'+this.state.thePostId)
                .then(function (response) {
                    commit('store_post', response.data);
                })
                .catch(function (error) {
                console.log("DEU ERRO getPost");
                });
            }else{
                // quando se cria um novo produto
                this.state.loadingAssets.post = 1;
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

    //   async save({ dispatch, commit }){

    //     console.log("save");

    //         axios.post("/editor/post/save", {post: this.state.post,})
    //         .then(response => {
    //             if (response.status != 200) {
    //             return new Error("Something went wrong");
    //             }

    //             dispatch('saveImages');
    //             dispatch('saveCover');

    //             return response.data;

    //         })
    //         .catch(function(error) {
    //             return 401;
    //         });


    //   },
      getEditorCats({commit }){

        console.log("getEditorCats");

            axios.get("/editor/get-cats")
            .then(response => {
                if (response.status != 200) {
                    return new Error("Something went wrong");
                }

                console.log(response.data);

                commit('store_cats', response.data);

                this.state.loadAssets.cats = 1;

            })
            .catch(function(error) {
                return 401;
            });


      },

    },

  })
