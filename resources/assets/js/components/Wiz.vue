<style>
  .wiz {

  }
  .wiz-menu {
    top: 4.5em;
    width: 15em;
    height: 100%;
    position: fixed;
    background-color: #fff;
  }
  .wiz-content {
    width: 60em;
    margin: 0 0 0 15em;
    float: left;
  }
</style>
<template>
  <div class="wiz">
    <div class="wiz-menu">
      <SideBar :mode="mode" :theme="theme" :active="active" :data="data" :width="width"></SideBar>
    </div>
    <div class="wiz-content">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
  import SideBar from '@/components/Sidebar'
  export default {
    components: {
      SideBar
    },
    data () {
      return {
        dataColumns : [],
        dataTable : [],
        theme: 'light',
        active: '',
        data: [
        ],
        mode: 'vertical',
        width: '15em'
      }
    },
    methods: {
      navList: function (data) {
        axios.get(this.globalUrl() + '/api/wizNotes/actions/navList')
        .then((response) => {
          this.data = response.data.data
          this.active = this.$route.params.id ? this.$route.params.id.toString() : response.data.default

        })
        .catch((error) => {
          this.error   = error.toString()
        });        
      },    
    },
    created() {
    },
    mounted() {
      this.data = this.navList()
    }
  }
</script>
