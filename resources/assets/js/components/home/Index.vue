<style lang="less">
    .layout{
        background: #fff;
        position: relative;
        border-radius: 0px;
        overflow: hidden;
    }
    .layout-header-bar{
        background: #fff;
        box-shadow: 0 1px 1px rgba(0,0,0,.1);
    }
    #particles{
        position: absolute;
        top: 0;
        z-index: -1;
        width: 100%;
        height: 99%;
        background-color: #ffffff;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: 50% 50%;
    }
</style>
<template>
    <div class="layout">
        <Card :style="{position: 'fixed', height: '100vh', left: 0, overflow: 'auto', width: '300px'}">
            <CellGroup>
                <Cell title="Only show titles" >Main</Cell>
            </CellGroup>
        </Card>
        <Layout :style="{marginLeft: '300px'}">
            <Header :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)'}"></Header>
            <Content :style="{padding: '0'}">
                <Card>
                    <div style="height: 600px">Content</div>
                </Card>
            </Content>
        </Layout>
    </div>
</template>

<script>
import particlesJson from '@/config/particles.json'
import homeJson from '@/config/home.json'
export default {
    data () {
        return {
            homeJson,
            hitokoto:{
                text: "Conte can't stop",
                from: "Conte"
            }
        }
    },
    created() {
        //this.getHitokoto()
    },
    mounted() {
        //particlesJS('particles', particlesJson);
    },
    methods: {
        getHitokoto() {
            axios.get('api/hitokoto')
                .then((response) => {
                    this.hitokoto = response.data
                })
                .catch((error) => {
                });
        },
        jump(val){
            this.$router.push(val);
        }
    }
}
</script>