<template>
  <div class="table-form-mensal">
    <el-row :gutter="20">
      <el-col :span="8" v-for="item in table">
        <h4><i class="fas fa-angle-right"></i> {{item.name}}</h4>
        <el-table :data="item.tableMensal" style="width: 100%" border>
          <el-table-column prop="date" label="Dia" width="50"></el-table-column>
          <el-table-column prop="date" label="Acumulado"></el-table-column>
          <el-table-column prop="date" label="Produção do Dia"></el-table-column>
        </el-table>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  props:['table'],
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
