<template>
	<SideBar :mode="mode" :theme="theme" :active="active" :data="data"></SideBar>
</template>
<script>
import SideBar from '@/components/Sidebar'
export default {
    components: {
        SideBar
    },
    data () {
        return {
            theme: 'light',
            mode: 'horizontal',
            active: '',
            data: [
                {
                    name: '/wiz',
                    to: '/wiz',
                    type: '',
                    des: 'Wiz'
                }
            ]
        }
    },
    methods: {
        navList: function (data) {
            axios.get(this.globalUrl() + '/api/notes/actions/navList')
            .then((response) => {
                this.data   = response.data.data
                this.active = this.$route.params.id ? this.$route.params.id.toString() : response.data.default

            })
            .catch((error) => {
              this.error = error.toString()
            });
        },
    }
}
</script>