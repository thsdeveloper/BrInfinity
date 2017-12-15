<template>
  <div class="report-table">
    <el-table :data="this.dados" style="width: 100%">
      <el-table-column prop="seguradora" label="Seguradora"></el-table-column>
      <el-table-column prop="January" label="Jan"></el-table-column>
      <el-table-column prop="February" label="Fev"></el-table-column>
      <el-table-column prop="March" label="Mar"></el-table-column>
      <el-table-column prop="April" label="Abr"></el-table-column>
      <el-table-column prop="May" label="Mai"></el-table-column>
      <el-table-column prop="June" label="Jun"></el-table-column>
      <el-table-column prop="July" label="Jul"></el-table-column>
      <el-table-column prop="August" label="Ago"></el-table-column>
      <el-table-column prop="September" label="Set"></el-table-column>
      <el-table-column prop="October" label="Out"></el-table-column>
      <el-table-column prop="November" label="Nov"></el-table-column>
      <el-table-column prop="December" label="Dez"></el-table-column>
      <el-table-column prop="total" label="TOTAL"></el-table-column>
    </el-table>

  </div>
</template>

<script>
export default {
  props:['dados'],
  data(){
    return {
    //  tableData: [this.dados],

    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
