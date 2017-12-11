<style scoped lang="less">
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
        background-color: #fff;
        display: flex;
    }
    .layout-menu {
        height: 4.5em;
        width: 100%;
        display: flex;
        margin: auto;
        justify-content:space-between;
    }
    .layout-content {
        top:4.5em;
        left: 0;
        width: 100%;
        position: relative;
    }
    .menu-logo {
        width: 15em;
        min-width: 15em;
        position: relative;
        img {
            position: absolute;
            bottom: 0;
            padding: 0 0 0 24px;
            vertical-align: middle;
            border-radius:0px;
        }
    }
    .menu-nav {
        width: 100%;
        .menu {
            bottom: 0;
            position: absolute;
        }
    }
    .content-title-nav {
        top: 4.5em;
        width: 15em;
        height: 100%;
        position: fixed;
        background-color: #fff;
    }
    .content-note {
        width: calc(100% - 15em);
        margin: 0 0 0 15em;
        float: left;
    }
</style>
<template>
    <div class="layout">
        <div class="layout-top">
            <div class="layout-menu">
                <div class="menu-logo">
                    <img :src="logoImg" height="60" alt="logoImg">
                </div>
            </div>
        </div>
        <div class="layout-content">
            <div>
                <div class="content-title-nav">
                    <TitleNav></TitleNav>
                </div>
                <div class="content-note">
                    <Note></Note>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import TagNav from '@/components/note/TagNav'
import TitleNav from '@/components/note/TitleNav'
import Note from '@/components/note/Note'
export default {
    components: {
        TagNav,
        TitleNav,
        Note
    },
    data () {
        return {
            logoImg: require('@/assets/img/logo-60x60.png')
        }
    }
}
</script>
