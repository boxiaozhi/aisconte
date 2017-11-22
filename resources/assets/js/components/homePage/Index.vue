<style lang="less">
    .c-main {
        position: absolute;
        top: 40%;
        left: 50%;
        width: 100%;
        transform: translate(-50%, -50%);
        .ivu-breadcrumb > span {
            font-weight: 400;
        }
        .ivu-icon {
            margin-right: 0.4em;
        }
        .ivu-avatar-large {
            width: 60px;
            height: 60px;
            border-radius: 30px;
        }
    }
    .c-bg-transparent {
        div {
            background: rgba(255,255,255,0.2);
        }
    }
    .c-center {
        text-align: center;
    }
    .c-icon-group {
        padding: 1em 0 0 0;
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
    <div>
        <div class="c-main">
            <Row class="c-bg-transparent" type="flex" justify="center" align="bottom">
                <Col class="c-center" :xs="{span:24}" :lg="{span:18}">
                    <Card dis-hover :bordered="false">
                        <div class="c-center">
                            <Avatar :src="homePageJson.logo" size="large"/>
                            <h3>{{ hitokoto.text }} - {{ hitokoto.from }}</h3>
                        </div>
                    </Card>
                </Col>
                <Col class="c-icon-group" :xs="{span:24}" :lg="{span:18}">
                    <div class="c-center">
                        <Breadcrumb separator="/">
                            <BreadcrumbItem v-for="nav in homePageJson.navs" :href="nav.href"><Icon :type="nav.iconType"></Icon>{{ nav.title }}</BreadcrumbItem>
                        </Breadcrumb>
                    </div>
                </Col>
            </Row>
        </div>
        <div id="particles"></div>
    </div>
</template>

<script>
import particlesJson from '@/config/particles.json'
import homePageJson from '@/config/homePage.json'
export default {
    data () {
        return {
            homePageJson,
            hitokoto:{
                text: "Conte can't stop",
                from: "Conte"
            }
        }
    },
    created() {
        this.getHitokoto()
    },
    mounted() {
        particlesJS('particles', particlesJson);
    },
    methods: {
        getHitokoto() {
            axios.get('api/hitokoto')
            .then((response) => {
                this.hitokoto = response.data
            })
            .catch((error) => {
            });            
        }
    }
}
</script>