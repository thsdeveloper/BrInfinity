<template>
  <div class="infinity-menu">
    <el-menu
    :default-active="activeIndex2"
    class="el-menu-demo"
    mode="horizontal"
    :unique-opened="true"
    @select="handleSelect"
    background-color="#545c64"
    text-color="#fff"
    active-text-color="#ffd04b">
    <el-menu-item index="1">Br Infinity</el-menu-item>
    <el-submenu index="2">
      <template slot="title">Produção</template>
      <el-menu-item index="2-1"><a href="/producao">Geral</a></el-menu-item>
      <el-menu-item index="2-2"><a href="/relatorio/mensal">Relatório Mensal</a></el-menu-item>
      <el-menu-item index="2-3"><a href="/relatorio">Relatório Anual</a></el-menu-item>
    </el-submenu>
  </el-menu>
</div>
</template>

<script>
export default {
  data(){
    return {
      activeIndex: '1',
      activeIndex2: '1'
    }
  },
  methods: {
    handleSelect(key, keyPath) {
      console.log(key, keyPath);
    }
  },
  mounted() {

  }
}
</script>
<style>

</style>
