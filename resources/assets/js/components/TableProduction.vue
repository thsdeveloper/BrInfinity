<template>
  <div class="tabel-producao">

    <template>
      <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column
      prop="date"
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
</template>

</div>
</template>

<script>
export default {
  props:['data'],
  data(){
    return {
      tableData: [{
        date: '2016-05-03',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-02',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-04',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }, {
        date: '2016-05-01',
        name: 'Tom',
        address: 'No. 189, Grove St, Los Angeles'
      }]
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
