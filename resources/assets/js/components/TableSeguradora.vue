<template>
  <div class="table-seguradora">

    <el-button type="success" class="btn-cadastrar" @click="dialogCadastro = true"><i class="fas fa-plus"></i> Cadastrar</el-button>
    <el-dialog title="Cadastrar nova Seguradora" :visible.sync="dialogCadastro" width="30%">

      <el-input placeholder="Insira o nome da Seguradora" v-model="seguradora"></el-input>

      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogCadastro = false">Cancelar</el-button>
        <el-button type="primary" @click="insert()">Inserir</el-button>
      </span>
    </el-dialog>

    <el-dialog title="Cadastrar nova Seguradora" :visible.sync="dialogAtualizar" width="30%">
      <el-input placeholder="Insira o nome da Seguradora" v-model="seguradora"></el-input>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="atualizar()">Atualizar</el-button>
      </span>
    </el-dialog>

    <el-table :data="this.data" style="width: 100%">
      <el-table-column prop="name" label="Seguradoras"></el-table-column>
      <el-table-column label="Ações">
        <template slot-scope="scope">
          <el-button size="mini" @click="editarSeguradora(scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
          <el-button size="mini" type="danger" @click="deletarSeguradora(scope.row.id)"><i class="fas fa-trash"></i> Excluir</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
export default {
  props:['data'],
  data(){
    return {
      dialogCadastro: false,
      dialogAtualizar: false,
      idAtualizacao: null,
      seguradora: null,
    }
  },
  methods: {
    insert(){
      axios.post('seguradora/inserir', {
        name: this.seguradora,
      })
      .then(function (response) {
        window.location.href = "/seguradoras";
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    editarSeguradora(row){
      this.dialogAtualizar = true;
      this.seguradora = row.name;
      this.idAtualizacao = row.id;
    },
    atualizar(){
      axios.post('seguradora/atualizar/'+this.idAtualizacao, {
        name: this.seguradora,
      })
      .then(function (response) {
        window.location.href = "/seguradoras";
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    deletarSeguradora(id){
      axios.post('seguradora/deletar/'+id)
      .then(function (response) {
        window.location.href = "/seguradoras";
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  },
  mounted() {

  }
}
</script>
<style>
.table-seguradora .btn-cadastrar{
  margin-bottom: 20px;
  float: right;
}
</style>
