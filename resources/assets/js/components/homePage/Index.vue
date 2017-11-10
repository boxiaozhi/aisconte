<style lang="less">
    .c-main {
        position: absolute;
        top: 40%;
        left: 50%;
        width: 100%;
        -webkit-transform: translate(-50%, -50%);
        .ivu-breadcrumb > span {
            font-weight: 400;
        }
        .ivu-icon {
            margin-right: 0.4em;
        }
    }
    .c-bg-transparent {
        div {
            background: rgba(255,255,255,0.2);
        }
    }
    .c-center {
        text-align: -webkit-center;
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
                    <Card :bordered="false">
                        <div class="c-center">
                            <img :src="logoImg" height="60" alt="logoImg">
                            <h3>Conte can't stop.</h3>
                        </div>
                    </Card>
                </Col>
                <Col class="c-icon-group" :xs="{span:24}" :lg="{span:18}">
                    <div class="c-center">
                        <Breadcrumb separator="/">
                            <BreadcrumbItem href="/"><Icon type="ios-home-outline"></Icon>Home</BreadcrumbItem>
                            <BreadcrumbItem href="/note"><Icon type="ios-albums-outline"></Icon>Note</BreadcrumbItem>
                        </Breadcrumb>
                    </div>
                </Col>
            </Row>
        </div>
        <div id="particles"></div>
    </div>
</template>

<script>
import particlesJson from '@/assets/particles.json'
export default {
    data () {
        return {
            logoImg: require('@/assets/img/logo-60x60.png')
        }
    },
    mounted() {
        particlesJS('particles', particlesJson);
    }
}
</script>