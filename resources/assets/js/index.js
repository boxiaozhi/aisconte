
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.showdown = require('showdown');
window.Vue = require('vue');

import iview from 'iview'
import router from '@/router/index'
import axios from 'axios'
import '!style-loader!css-loader!less-loader!@/theme/index.less'

import index from '@/components/Index'
import globalPlugins from '@/components/GlobalPlugins'

Vue.use(iview, axios)
Vue.use(globalPlugins)

const indexVue = new Vue({
    el: '#index',
	router,
	template: '<index/>',
	components: { index }
})

router.beforeEach((to, from, next) => {
  iview.LoadingBar.start();
  next();
})

router.afterEach(route => {
  iview.LoadingBar.finish();
})