<template>
  <div class="report-table">
    <div class="row">
      <div class="col-md-6">
        <a href="/downloadAnual/xls"><button class="btn btn-success">Download Excel xls</button></a>
        <a href="/downloadAnual/xlsx"><button class="btn btn-success">Download Excel xlsx</button></a>
        <a href="/downloadAnual/csv"><button class="btn btn-success">Download Excel csv</button></a>
      </div>
    </div>

    <el-table :data="this.tableData" style="width: 100%">
      <el-table-column prop="seguradora" label="Seguradora"></el-table-column>
      <el-table-column prop="janeiro" label="Jan"></el-table-column>
      <el-table-column prop="fevereiro" label="Fev"></el-table-column>
      <el-table-column prop="marco" label="Mar"></el-table-column>
      <el-table-column prop="abril" label="Abr"></el-table-column>
      <el-table-column prop="maio" label="Mai"></el-table-column>
      <el-table-column prop="junho" label="Jun"></el-table-column>
      <el-table-column prop="julho" label="Jul"></el-table-column>
      <el-table-column prop="agosto" label="Ago"></el-table-column>
      <el-table-column prop="setembro" label="Set"></el-table-column>
      <el-table-column prop="outubro" label="Out"></el-table-column>
      <el-table-column prop="novembro" label="Nov"></el-table-column>
      <el-table-column prop="dezembro" label="Dez"></el-table-column>
      <el-table-column prop="total" label="TOTAL"></el-table-column>
    </el-table>

  </div>
</template>

<script>
export default {
  props:['dados'],
  data(){
    return {
      tableData: [{
        seguradora: 'Seguradora 1',
        janeiro: 'R$ 786',
        fevereiro: 'R$ 786',
        marco: 'R$ 786',
        abril: 'R$ 786',
        maio: 'R$ 786',
        junho: 'R$ 786',
        julho: 'R$ 786',
        agosto: 'R$ 786',
        setembro: 'R$ 786',
        outubro: 'R$ 786',
        novembro: 'R$ 786',
        dezembro: 'R$ 786',
        total: 'R$ 98765'
      }, {
        seguradora: 'Seguradora 2',
        janeiro: 'R$ 786',
        fevereiro: 'R$ 786',
        marco: 'R$ 786',
        abril: 'R$ 786',
        maio: 'R$ 786',
        junho: 'R$ 786',
        julho: 'R$ 786',
        agosto: 'R$ 786',
        setembro: 'R$ 786',
        outubro: 'R$ 786',
        novembro: 'R$ 786',
        dezembro: 'R$ 786',
        total: 'R$ 98765'
      }, {
        seguradora: 'Seguradora 3',
        janeiro: 'R$ 786',
        fevereiro: 'R$ 786',
        marco: 'R$ 786',
        abril: 'R$ 786',
        maio: 'R$ 786',
        junho: 'R$ 786',
        julho: 'R$ 786',
        agosto: 'R$ 786',
        setembro: 'R$ 786',
        outubro: 'R$ 786',
        novembro: 'R$ 786',
        dezembro: 'R$ 786',
        total: 'R$ 98765'
      }, {
        seguradora: 'Seguradora 4',
        janeiro: 'R$ 786',
        fevereiro: 'R$ 786',
        marco: 'R$ 786',
        abril: 'R$ 786',
        maio: 'R$ 786',
        junho: 'R$ 786',
        julho: 'R$ 786',
        agosto: 'R$ 786',
        setembro: 'R$ 786',
        outubro: 'R$ 786',
        novembro: 'R$ 786',
        dezembro: 'R$ 786',
        total: 'R$ 98765'
      }]

    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
