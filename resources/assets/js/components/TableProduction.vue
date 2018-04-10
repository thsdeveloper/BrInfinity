<template>
  <div class="tabel-producao">

    <!-- <table class="table">
      <thead>
        <tr>
          <th scope="col">Corretoras</th>
          <th scope="col" v-for="s in seguradoras" :key="s.id">{{s.name}}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="c in corretoras" :key="c.id">
          <th scope="row">{{c.name}}</th>
          <td v-for="s in seguradoras" :key="s.id">
            <div v-for="p in producoes" :key="p.id" v-if="p.seguradora_id === s.id && p.corretora_id === c.id">
              {{p.total}}
            </div>
          </td>
        </tr>
      </tbody>
    </table> -->




    <el-table style="width: 100%" :data="corretoras" border>

      <el-table-column  label="Corretoras" width="500">
        <template slot-scope="scope">
          <span style="margin-left: 10px">{{ scope.row.name }}</span>
        </template>
      </el-table-column>


      <el-table-column  :label="s.name" v-for="s in seguradoras" :key="s.id">
        <template slot-scope="scope">
          <div v-for="p in producoes" :key="p.id" v-if="p.seguradora_id === s.id && p.corretora_id === scope.row.id" style="text-align: center">
            <el-button type="text">R$ {{p.total}}</el-button>
          </div>
        </template>
      </el-table-column>

    </el-table>



  </div>
</template>

<script>
export default {
  props:['corretoras', 'seguradoras', 'producoes'],
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
