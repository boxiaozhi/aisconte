<style scoped>
  #index{
    height: 100%;
    width: 100%;
  }
</style>
<template>
  <div id="index">
    <router-view name="blank"></router-view>
    <router-view></router-view>
  </div>
</template>
<script>
  export default {
    name: 'index'
  }
</script>
