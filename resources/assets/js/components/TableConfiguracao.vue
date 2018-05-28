<template>
  <div class="table-configuracao">

    <el-tabs type="border-card">
      <el-tab-pane label="Funções de Usuários">
        <el-button type="success" @click="insertRole()"><i class="fas fa-plus"></i> Nova função</el-button>
        <el-table :data="roles">
          <el-table-column prop="display_name" label="Nome"></el-table-column>
          <el-table-column prop="description" label="Descrição"></el-table-column>
          <el-table-column label="Ações">
            <template slot-scope="scope">
              <el-button size="mini" @click="editRole(scope.$index, scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
              <el-button size="mini" type="danger" @click.native.prevent="deleteRole(scope.$index, roles, scope.row)"><i class="fas fa-trash"></i> Excluir</el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-tab-pane>

      <el-tab-pane label="Notificações">Notificações...</el-tab-pane>
      <el-tab-pane label="Codigo BNC">Codigo BNC..</el-tab-pane>
      <el-tab-pane label="Email Marketing">Email Marketing...</el-tab-pane>
    </el-tabs>

    <el-dialog :title="title" :visible.sync="dialogEditRole" width="30%" :before-close="closeDialog">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
        <el-form-item prop="display_name">
          <el-input v-model="ruleForm.display_name" placeholder="Nome da Função"></el-input>
        </el-form-item>
        <el-form-item prop="description">
          <el-input v-model="ruleForm.description" placeholder="Descrição"></el-input>
        </el-form-item>
        <el-form-item v-if="buttonInsertVisible">
          <el-button type="primary" @click="insertForm('ruleForm')"><i class="fas fa-edit"></i> Inserir função</el-button>
        </el-form-item>
        <el-form-item v-if="buttonEditVisible">
          <el-button type="primary" @click="editForm('ruleForm')"><i class="fas fa-edit"></i> Editar função</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
  </div>
</template>

<script>
export default {
  data(){
    return {
      title: null,
      typeForm: null,
      idRole: null,
      buttonInsertVisible: false,
      buttonEditVisible: false,

      roles: null,
      dialogEditRole: false,
      ruleForm: {
        display_name: '',
        description: '',
      },
      rules: {
        display_name: [
          {required: true, message: 'Escreva o nome da função', trigger: 'blur'},
        ],
        description: [
          { required: true, message: 'Escreva uma descrição para a função', trigger: 'blur' }
        ],
      }
    }
  },
  methods: {
    insertRole(){
      this.title = "Inserir funções de usuários";
      this.buttonInsertVisible = true;
      this.dialogEditRole = true;
    },
    editRole(index, row) {
      this.title = "Editar funções de usuários";
      this.buttonEditVisible = true;
      this.ruleForm.display_name = row.display_name;
      this.ruleForm.description = row.description;
      this.dialogEditRole = true;
      this.idRole = row.id;
    },
    deleteRole(index, rows, row) {
      var _this = this;
      this.$confirm('Você deseja realmente excluir a função', 'Atenção', {
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        type: 'warning'
      }).then(() => {
        axios.post('/role/delete', {
          id: row.id,
        })
        .then(function (response) {
          rows.splice(index, 1);
          _this.$message({
            type: 'success',
            message: 'Função excluída com sucesso'
          });
        }).catch(function (error) {});
      }).catch(() => {});
    },
    closeDialog(done) {
      this.$confirm('Deseja realmente fechar?')
      .then(_ => {
        done();
        this.buttonInsertVisible = false;
        this.buttonEditVisible = false;
        this.ruleForm.display_name = "";
        this.ruleForm.description = "";
      })
      .catch(_ => {

      });
    },
    insertForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          axios.post('/role/insert', {
            display_name: this.ruleForm.display_name,
            description: this.ruleForm.description,
          })
          .then(function (response) {
            window.location.replace("/configuracoes");
          }).catch(function (error) {});
        } else {
          return false;
        }
      });
    },
    editForm(formName) {
      var _this = this;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          axios.post('/role/update', {
            id: this.idRole,
            display_name: this.ruleForm.display_name,
            description: this.ruleForm.description,
          })
          .then(function (response) {
            window.location.replace("/configuracoes");
          }).catch(function (error) {});
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
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
