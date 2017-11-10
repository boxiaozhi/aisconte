<style lang="less">
    .note {
        position: absolute;
        width: calc(100% - 15em);
        height: calc(100% - 4.5em);
    }
    .ivu-spin-fix {
        position: fixed;
    }
    .note-content {
        padding: 2em;
        img {
            width: 60em;
        }
        ul {
            list-style: disc !important;
            padding: 0 0 0 2em !important;
        }
    }
</style>
<template>
    <div class="note">
        <div v-if="loading">
            <Spin fix></Spin>
        </div>
        <div class="note-content" v-html="conHtml" v-highlight v-else></div>
    </div>
</template>
<script>
export default {
    data () {
        return {
            loading: true,
            title: '',
            conHtml: ''
        }
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
                this.conHtml = response.data.content
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
    }
}
</script>
