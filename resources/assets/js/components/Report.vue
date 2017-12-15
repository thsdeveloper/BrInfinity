<template>
  <div class="report-brinfinite">

    <el-button type="primary" class="pull-right" @click="dialogVisible = true" icon="el-icon-document">Visualizar o gráfico</el-button>

    <el-dialog
    title="Gráfico Anual"
    :visible.sync="dialogVisible"
    width="80%"
    :before-close="handleClose"
    top="10px">

    <canvas id="mycanvas2" count="2"></canvas>
    <chartjs-bar target="mycanvas2"
    :labels="meses"
    :datalabel="row.seguradora"
    :data="row.valores"
    v-for="(row, index) in this.dados"
    v-bind:key="index">
  </chartjs-bar>

</el-dialog>





</div>
</div>
</template>

<script>
export default {
  props:['dados'],
  data(){
    return {
      dialogVisible: false,
      meses : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      data : [50, 90, 50, 90, 50, 90, 50, 100, 40, 232, 40, 567]
    }
  },
  methods: {
    handleClose(done) {
      this.$confirm('Deseja fechar o gráfico?')
      .then(_ => {
        done();
      })
      .catch(_ => {});
    }
  },
  mounted() {

  }
}
</script>
