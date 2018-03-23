<template>
  <div class="tabel-producao">
    <el-table :data="items" style="width: 100%">

     <el-table-column
       prop="corretora"
       label="Corretoras"
       width="180">
     </el-table-column>

     <el-table-column
       prop="name"
       label="Name"
       width="180">
     </el-table-column>

     <el-table-column
       prop="address"
       label="Address">
     </el-table-column>
   </el-table>
  </div>
</template>

<script>
export default {
  props:['corretoras', 'seguradoras', 'producoes'],
  data(){
    return {
      items: [
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        },
        {
          corretora: "Corretora 1",
        }
      ]
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
