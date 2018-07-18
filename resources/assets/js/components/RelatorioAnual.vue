<template>
  <div class="report-table">

    <data-tables :data="table" style="width: 100%" border :show-action-bar="false" :custom-filters="customFilters">
      <el-row slot="custom-tool-bar" style="margin-bottom: 20px; margin-top: 20px" :gutter="20">
        <el-col :span="4">
          <el-select v-model="customFilters[1].vals" clearable placeholder="Filtrar por seguradoras" class="selectMold">
            <el-option :label="t.seguradora" :value="t.seguradora" v-for="t in table" :key="t.id"></el-option>
          </el-select>
        </el-col>
        <el-col :span="20">
          <a href="downloadReport/xls"><button class="btn btn-success">Download Excel xls</button></a>
          <a href="downloadReport/xlsx"><button class="btn btn-success">Download Excel xlsx</button></a>
          <a href="downloadReport/csv"><button class="btn btn-success">Download Excel csv</button></a>
        </el-col>
      </el-row>



      <el-table-column prop="seguradora" label="Seguradora"></el-table-column>
      <el-table-column label="Jan">
        <template slot-scope="scope">
          {{ scope.row.January | real }}
        </template>
      </el-table-column>
      <el-table-column prop="February" label="Fev">
        <template slot-scope="scope">
          {{ scope.row.February | real }}
        </template>
      </el-table-column>
      <el-table-column prop="March" label="Mar">
        <template slot-scope="scope">
          {{ scope.row.March | real }}
        </template>
      </el-table-column>
      <el-table-column prop="April" label="Abr">
        <template slot-scope="scope">
          {{ scope.row.April | real }}
        </template>
      </el-table-column>
      <el-table-column prop="May" label="Mai">
        <template slot-scope="scope">
          {{ scope.row.May | real }}
        </template>
      </el-table-column>
      <el-table-column prop="June" label="Jun">
        <template slot-scope="scope">
          {{ scope.row.June | real }}
        </template>
      </el-table-column>
      <el-table-column prop="July" label="Jul">
        <template slot-scope="scope">
          {{ scope.row.July | real }}
        </template>
      </el-table-column>
      <el-table-column prop="August" label="Ago">
        <template slot-scope="scope">
          {{ scope.row.August | real }}
        </template>
      </el-table-column>
      <el-table-column prop="September" label="Set">
        <template slot-scope="scope">
          {{ scope.row.September | real }}
        </template>
      </el-table-column>
      <el-table-column prop="October" label="Out">
        <template slot-scope="scope">
          {{ scope.row.October | real }}
        </template>
      </el-table-column>
      <el-table-column prop="November" label="Nov">
        <template slot-scope="scope">
          {{ scope.row.November | real }}
        </template>
      </el-table-column>
      <el-table-column prop="December" label="Dez">
        <template slot-scope="scope">
          {{ scope.row.December | real }}
        </template>
      </el-table-column>
      <el-table-column prop="total" label="Gráficos">
        <template slot-scope="scope">
          <el-button size="mini" round @click="verGrafico(scope.row)"><i class="far fa-chart-bar"></i> Ver gráfico</el-button>
        </template>
      </el-table-column>
      <el-table-column prop="total" label="TOTAL">
        <template slot-scope="scope">
          <strong>{{ scope.row.total | real }}</strong>
        </template>
      </el-table-column>

    </data-tables>



    <el-dialog title="Gráfico Anual de Produção" :visible.sync="dialogVisible" width="70%" top="55px" :before-close="handleClose">
      Grafico

      <!-- <canvas id="mycanvas" count="8"></canvas> -->
      <chartjs-bar :datalabel="mylabel" :labels="mylabels" :data="mydata"></chartjs-bar>
    </el-dialog>



  </div>
</template>

<script>
export default {
  props:['table'],
  data(){
    return {
      //Filter Tbale
      customFilters: [{vals: '', props: 'proponent'}, {vals: '', props: 'seguradora'}],
      dialogVisible: false,

      mylabel : null,
      mylabels : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      mydata : []

    }
  },
  methods: {
    verGrafico(row){

      this.mylabel = row.seguradora;
      this.mydata = [row.January, row.February, row.March, row.April, row.May, row.June, row.July, row.August, row.September, row.October, row.November, row.December,]

      this.dialogVisible = true;
      console.log(row);
    },

    handleClose(done) {
      this.$confirm('Deseja fechar o gráfico?')
      .then(_ => {
        window.location.href = "/relatorio";
        done();
      })
      .catch(_ => {});
    }
  },
  filters: {
    real(value) {
      return  `R$ ${value}`;
    }
  },
  mounted () {

  }
}
</script>
<style>
.el-select.selectMold {
  width: 100%;
}
.drop-panilha {
  float: right;
}
</style>
