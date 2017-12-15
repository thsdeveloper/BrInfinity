<template>
  <div class="report-table-mensal">


    <div class="col-md-4" v-for="(row, index) in this.seguradoras" v-bind:key="index">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title text-center">{{row.name}}</h3>
        </div>
        <div class="panel-body">

          <el-table :data="dados" style="width: 100%" >
            <el-table-column prop="date" label="Dia"></el-table-column>
            <el-table-column prop="value" label="Aculumado"></el-table-column>
            <el-table-column prop="value" label="Produção do dia"></el-table-column>
          </el-table>

        </div>
      </div>
    </div>



  </div>
</template>

<script>
export default {
  props:['dados', 'seguradoras'],
  data(){
    return {

    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
