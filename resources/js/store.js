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
      },

    },
    actions: {
      setPost({ commit }, post){
        this.commit('store_setPost', post);
      },
      setCover({ commit }, image){
        // this.commit('store_setPost', image);
      },

    },

  })
