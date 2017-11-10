<template>
    <Menu class="menu" ref="menu" :mode="mode" :theme="theme" :active-name="active" :width="width">
        <MenuItem v-for="item in data" :key="item.name" :name="item.name">
            <router-link :to="item.to">
                <Icon v-if="item.type != ''" :type="item.type"></Icon>
                {{ item.des }}
            </router-link>
        </MenuItem>
    </Menu>
</template>
<script>
export default {
    name: 'SideBar',
    props: {
        data: Array,
        theme: {
            type: String,
            default: 'light' //dark
        },
        mode: {
            type: String,
            default: 'vertical'
        },
        active: String,
        width: {
            type: String,
            default: 'auto'
        }
    },
    watch: {
        active: function() {
            this.$nextTick(function(){
                this.$refs.menu.updateActiveName()
            })
        }
    }
}
</script>