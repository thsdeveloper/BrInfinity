<template>
  <div class="table-users">
    <el-table :data="users" style="width: 100%">
      <el-table-column prop="name" label="Usuários"></el-table-column>
      <el-table-column prop="email" label="Email"></el-table-column>
      <el-table-column label="Permissão">
        <template slot-scope="scope">
          <el-tag>Administrador</el-tag>
        </template>
      </el-table-column>
      <el-table-column
      label="Operations">
      <template slot-scope="scope">
        <el-button size="mini" @click="editUser(scope.$index, scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
        <el-button size="mini" type="danger" @click="deleteUser(scope.$index, scope.row)"><i class="fas fa-trash-alt"></i> Excluir</el-button>
      </template>
    </el-table-column>
  </el-table>

  <el-dialog title="Editar Usuário" :visible.sync="dialogEditUser" width="30%" :before-close="closeDialog">
    <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
      <el-form-item prop="name">
        <el-input v-model="ruleForm.name"></el-input>
      </el-form-item>
      <el-form-item prop="email">
        <el-input v-model="ruleForm.email"></el-input>
      </el-form-item>
      <el-form-item prop="role">
        <el-select v-model="ruleForm.role" placeholder="Escolha uma permissão">
          <el-option v-for="r in roles" :key="r.id" :label="r.display_name" :value="r.id">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="submitForm('ruleForm')"><i class="fas fa-edit"></i> Alterar usuário</el-button>
      </el-form-item>
    </el-form>
  </el-dialog>

</div>
</template>

<script>
export default {
  props:['users'],
  data(){
    return {
      //Permisoes do usuarios
      roles: null,

      //dialog
      dialogEditUser: false,

      ruleForm: {
        name: '',
        email: '',
        role: '',
      },
      rules: {
        name: [
          { required: true, message: 'Escreva o novo nome', trigger: 'blur' },
        ],
        email: [
          { required: true, type: 'email', message: 'Escreva um e-mail válido', trigger: 'blur, change' }
        ],
        role: [
          { required: true, message: 'Escolha uma permissão para este usuário', trigger: 'change' }
        ],
      }
    }
  },
  methods: {
    editUser(index, row) {
      this.ruleForm.name = row.name;
      this.ruleForm.email = row.email;

      this.dialogEditUser = true;
    },
    deleteUser(index, row) {

    },
    closeDialog(done) {
      this.$confirm('Deseja fechar o modal?')
      .then(_ => {
        done();
      })
      .catch(_ => {});
    },
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          alert('submit!');
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
  computed: {

  },
}
</script>
<style>

</style>
