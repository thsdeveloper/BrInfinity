<template>
  <div class="table-configuracao">

    <el-tabs type="border-card">
      <el-tab-pane label="Funções de Usuários">
        <el-button type="success"><i class="fas fa-plus"></i> Nova função</el-button>
        <el-table :data="roles">
          <el-table-column prop="display_name" label="Nome"></el-table-column>
          <el-table-column prop="description" label="Descrição"></el-table-column>
          <el-table-column label="Ações">
            <template slot-scope="scope">
              <el-button size="mini" @click="editRole(scope.$index, scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
              <el-button size="mini" type="danger" @click="deleteRole(scope.$index, scope.row)"><i class="fas fa-trash"></i> Excluir</el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-tab-pane>


      <el-tab-pane label="Notificações">Notificações...</el-tab-pane>
      <el-tab-pane label="Codigo BNC">Codigo BNC..</el-tab-pane>
      <el-tab-pane label="Email Marketing">Email Marketing...</el-tab-pane>
    </el-tabs>
  </div>
</template>

<script>
export default {
  data(){
    return {
      roles: null,
    }
  },
  methods: {
    editRole(index, row) {
      console.log(index, row);
    },
    deleteRole(index, row) {
      console.log(index, row);
    }
  },
  mounted() {
    var _this = this;
    //Retorna as Permicoes de usuario no banco
    axios.get('/roles')
    .then(function (response) {
      _this.roles = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });
  },
}
</script>
