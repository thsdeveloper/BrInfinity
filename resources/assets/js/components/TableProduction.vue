<template>
  <div class="tabel-producao">
    <el-table :data="this.productions" stripe style="width: 100%">

      <el-table-column prop="broker.name" label="Corretoras"></el-table-column>
      <el-table-column prop="insurer_production.value" label="Total"></el-table-column>

    </el-table>
  </div>
</template>

<script>
export default {
  props:['productions'],
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
