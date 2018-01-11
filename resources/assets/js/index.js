
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import iview from 'iview'
import ElementUI from 'element-ui'
import router from '@/router/index'
import axios from 'axios'
import vuex from 'vuex'

import hljs from 'highlight.js'
import 'highlight.js/styles/solarized-dark.css'
import particlesJS from 'particles.js'

import index from '@/components/Index'
import globalPlugins from '@/components/GlobalPlugins'
import '!style-loader!css-loader!less-loader!@/theme/index.less'
import '!style-loader!css-loader!element-ui/lib/theme-chalk/index.css'

Vue.use(iview, axios)
Vue.use(vuex)
Vue.use(particlesJS)
Vue.use(globalPlugins)
Vue.use(ElementUI)

const indexVue = new Vue({
    el: '#index',
    template: '<index/>',
    components: { index },
    router
})

Vue.directive('highlight', function (el) {
    let blocks = el.querySelectorAll('pre code');
    blocks.forEach((block)=>{
        hljs.highlightBlock(block)
    })
})

router.beforeEach((to, from, next) => {
    iview.LoadingBar.start();
    next();
})

router.afterEach(route => {
    iview.LoadingBar.finish();
})