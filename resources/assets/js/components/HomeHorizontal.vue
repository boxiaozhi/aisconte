<style scoped>
  .layout {
    min-width: 75em;
  }
  .layout-top {
    top: 0;
    left: 0;
    width: 100%;
    height: 4.5em;
    position: fixed;
    z-index: 999;
    border-bottom: 1px solid #dddee1;
    /*background-color: hsla(0,0%,100%,.6);*/
    background-color: #fff;
    display: flex;
  }
  .layout-menu {
    height: 4.5em;
    width: 75em;
    min-width: 75em;
    display: flex;
    margin: auto;
    justify-content:space-between;
  }
  .menu-logo {
    width: 15em;
    position: relative;
  }
  .menu-logo img {
    position: absolute;
    bottom: 0;
    vertical-align: middle;
    border-radius:0px;    
  }
  .menu-nav {
    width: 60em;
  }
  .menu {
    bottom: 0;
    position: absolute;
  }
  .layout-content {
    top:4.5em;
    left: calc(50% - 37.5em);
    width: 75em;
    position: relative;
  }
</style>
<template>
  <div class="layout">
    <div class="layout-top">
      <div class="layout-menu">
          <div class="menu-logo">
            <img :src="logoImg" height="60" alt="logoImg">
          </div>
          <div class="menu-nav">
            <SideBar :mode="mode" :theme="theme" :active="active" :data="data" ></SideBar>
          </div>
      </div>
    </div>
    <div class="layout-content">
    	<router-view></router-view>
  	</div>
  </div>
</template>
<script>
  import SideBar from '@/components/Sidebar'
  export default {
    name: 'index',
    components: {
      SideBar
    },
    data () {
      return {
        theme: 'light',
        active: '',
        data: [
          {
            name: '/wiz',
            to: '/wiz',
            type: '',
            des: 'Wiz'              
          }
        ],
        mode: 'horizontal',
        logoImg: require('@/assets/img/logo-60x60.png')
      }
    },
  	methods: {
  	},
    created() {
      this.active = this.$route.matched[1]['path'];
    },
    watch: {
      $route () {
        this.active = this.$route.matched[1]['path'];
      }
    }
  }
</script>
