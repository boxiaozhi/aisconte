<style>
  .note {
    width: 60em;
    height: calc(100% - 4.5em);
    position: absolute;
  }
  .ivu-spin-fix {
    position: fixed;
  }
  .note-content {
    padding: 1em;
  }
</style>
<template>
    <div class="note">
      <div v-if="loading">
        <Spin fix></Spin>
      </div>
      <noteContent v-else></noteContent>
    </div>

</template>
<script>
export default {
  created(){
  },
  mounted(){
    this.dataList()
  },
  watch: {
    $route () {
      this.dataList()
    }
  },  
  methods: {
    dataList: function (data) {
      this.loading = true
      axios.get(this.globalUrl() + '/api/wizNotes/actions/note/' + this.getRouteId())
      .then((response) => {
        if(response.data.md){
          const converter = new showdown.Converter({strikethrough: true})
          this.conHtml = converter.makeHtml(response.data.content)
        } else {
          this.conHtml = response.data.content
        }
        Vue.component('noteContent', {
          template: '<div class="note-content">' + this.conHtml + '</div>'
        })    
        this.loading = false
      })
      .catch((error) => {
        this.loading = false
        this.error   = error.toString()
      });        
    },
    getRouteId: function (data) {
      return this.$route.params.id ? this.$route.params.id : 0
    }
  },
  data () {
    return {
      loading: true,
      title: '',
      conHtml: ''
    }
  }
}
</script>
