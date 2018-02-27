<template>
  <div class="tabel-producao">
    <el-table :data="this.data" stripe style="width: 100%">

      <el-table-column prop="broker.name" label="Corretoras"></el-table-column>
      <el-table-column prop="value" :label="insurer.name" v-for="insurer in this.insurers" :key="insurer.id"></el-table-column>
      <el-table-column prop="value" label="Total"></el-table-column>

    </el-table>
  </div>
</template>

<script>
export default {
  props:['data', 'insurers'],
  data(){
    return {

    }
  },
  methods: {

  },
  mounted() {
    console.log("Componente Table Montado");
  }
}
</script>
<style>

</style>
