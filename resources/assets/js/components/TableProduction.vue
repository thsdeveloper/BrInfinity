<template>
  <div class="tabel-producao">

    <template>
      <el-table :data="corretoras" style="width: 100%">

        <el-table-column prop="name" label="Corretoras"></el-table-column>

        <el-table-column prop="name" label="Seguradoras"></el-table-column>



      </el-table>
    </template>

  </div>
</template>

<script>
export default {
  props:['corretoras'],
  data(){
    return {

    }
  },
  methods: {

  },
  mounted() {
    console.log("Componente Table Montado");
  },
  computed: {

  },
}
</script>
<style>

</style>
