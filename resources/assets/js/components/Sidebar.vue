<template>
    <Menu :mode="mode" :theme="theme" :active-name="active" :width="width" class="menu" ref="menu">
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
      theme: {
        type: String,
        default: 'light' //dark
      },
      width: {
        type: String,
        default: 'auto'
      },
      active: String,
      data: Array,
      mode: {
        type: String,
        default: 'vertical'
      }
    },
    created() {
    },
    watch: {
      active: function() {
        console.log(this.active);
        this.$nextTick(function(){
          this.$refs.menu.updateActiveName()
        })
      }
    },
    mounted() {
    }  
  }
</script>