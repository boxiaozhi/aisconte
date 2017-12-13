<template>
	<SideBar :mode="mode" :theme="theme" :active="active" :data="data" :width="width"></SideBar>
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
        mode: 'vertical',
        active: '',
        width: '15em',
        data: []
      }
    },
    methods: {
        navList: function (data) {
            axios.get(this.globalUrl() + '/api/note/nav')
            .then((response) => {
                this.data   = response.data.data
                this.active = this.$route.params.id ? this.$route.params.id.toString() : response.data.default
            })
            .catch((error) => {
                this.error = error.toString()
            });
        }
    },
    mounted() {
        this.data = this.navList()
    }
}
</script>