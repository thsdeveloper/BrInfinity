<template>
  <div class="table-corretora">

    <el-button type="success" class="btn-cadastrar" @click="dialogCadastro = true"><i class="fas fa-plus"></i> Cadastrar</el-button>
    <el-dialog title="Cadastrar nova corretora" :visible.sync="dialogCadastro" width="50%">
      <el-form :model="formCorretora" :rules="rules" ref="ruleForm">
        <el-form-item prop="name">
          <el-input v-model="formCorretora.name" placeholder="Nome da corretora"></el-input>
        </el-form-item>
        <el-form-item prop="cnpj">
          <el-input v-model="formCorretora.cnpj" placeholder="CNPJ"></el-input>
        </el-form-item>
        <el-form-item prop="telefone">
          <el-input v-model="formCorretora.telefone" placeholder="Telefone"></el-input>
        </el-form-item>
        <el-form-item prop="email">
          <el-input v-model="formCorretora.email" placeholder="Email"></el-input>
        </el-form-item>
        <el-form-item prop="endereco">
          <el-input v-model="formCorretora.endereco" placeholder="Endereço"></el-input>
        </el-form-item>
        <el-form-item prop="seguradora">
          <el-select v-model="formCorretora.seguradora" multiple placeholder="Escolha as seguradoras">
            <el-option v-for="seg in seguradoras" :key="seg.id" :label="seg.name" :value="seg.id"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="submitForm('ruleForm')">Cadastrar</el-button>
          <el-button @click="resetForm('ruleForm')">Limpar</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>

    <el-dialog title="Cadastrar nova corretora" :visible.sync="dialogAtualizar" width="50%">

      <el-form :model="formCorretora" :rules="rules" ref="ruleForm">
        <el-form-item prop="name">
          <el-input v-model="formCorretora.name" placeholder="Nome da corretora"></el-input>
        </el-form-item>
        <el-form-item prop="cnpj">
          <el-input v-model="formCorretora.cnpj" placeholder="CNPJ"></el-input>
        </el-form-item>
        <el-form-item prop="telefone">
          <el-input v-model="formCorretora.telefone" placeholder="Telefone"></el-input>
        </el-form-item>
        <el-form-item prop="email">
          <el-input v-model="formCorretora.email" placeholder="Email"></el-input>
        </el-form-item>
        <el-form-item prop="endereco">
          <el-input v-model="formCorretora.endereco" placeholder="Endereço"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="atualizar()">Atualizar</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>
    <el-table :data="this.dadosCorretoras" style="width: 100%">
      <el-table-column prop="name" label="Corretoras"></el-table-column>
      <el-table-column label="Ações">
        <template slot-scope="scope">
          <el-button size="mini" @click="editarCorretora(scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
          <el-button size="mini" type="danger" @click="deletarCorretora(scope.row.id, scope.$index)"><i class="fas fa-trash"></i> Excluir</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
export default {
  props:['corretoras', 'seguradoras'],
  data(){
    return {
      dadosCorretoras: this.corretoras,
      dialogCadastro: false,
      dialogAtualizar: false,
      idAtualizacao: null,
      formCorretora: {
        name: null,
        cnpj: null,
        telefone: null,
        email: null,
        endereco: null,
        comercial: null,
        seguradora: []
      },
      rules: {
        name: [
          { required: true, message: 'Insira o nome da corretora', trigger: 'blur' },
        ],
        cnpj: [
          { required: true, message: 'Insiraum CNPJ', trigger: 'blur' },
        ],
        telefone: [
          { required: true, message: 'Insira um telefone', trigger: 'blur' },
        ],
        email: [
          { required: true, message: 'Insira um email valido', trigger: 'blur' },
        ],
        endereco: [
          { required: true, message: 'Insirao endereco', trigger: 'blur' },
        ],
        seguradora: [
          { required: true, message: 'Escolha as seguradoras', trigger: 'blur' },
        ],
      }
    }
  },
  methods: {
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          axios.post('corretora/inserir', {
            name: this.formCorretora.name,
            cnpj: this.formCorretora.cnpj,
            telefone: this.formCorretora.telefone,
            email: this.formCorretora.email,
            endereco: this.formCorretora.endereco,
            seguradora: this.formCorretora.seguradora
          })
          .then(function (response) {
            window.location.href = "/corretoras";
            console.log(response);
          })
          .catch(function (error) {
            console.log(error);
          });
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    editarCorretora(row){
      this.dialogAtualizar = true;
      this.idAtualizacao = row.id;
      this.formCorretora.name = row.name;
      this.formCorretora.cnpj = row.cnpj;
      this.formCorretora.telefone = row.phone;
      this.formCorretora.email = row.email;
      this.formCorretora.endereco = row.address;
    },
    atualizar(){
      axios.post('corretora/atualizar/',{
        id: this.idAtualizacao,
        name: this.formCorretora.name,
        cnpj: this.formCorretora.cnpj,
        telefone: this.formCorretora.telefone,
        email: this.formCorretora.email,
        endereco: this.formCorretora.endereco,
      })
      .then(function (response) {
        // window.location.href = "/corretoras";
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    deletarCorretora(id, index){
      var _this = this;

      _this.$confirm('Excluindo essa corretora você pode perder TODOS os seus registros de produção', 'Excluir corretora?', {
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        type: 'warning'
      }).then(() => {
        axios.post('corretora/deletar/'+id).then(function (r) {
          _this.dadosCorretoras.splice(index, 1);
          _this.$message({
            type: 'success',
            message: 'Corretora excluída com sucesso!'
          });
        })
        .catch(function (error) {
          console.log(error);
        });
      }).catch(() => {});
    }
  },
  mounted() {

  }
}
</script>
<style>
.table-corretora .btn-cadastrar{
  margin-bottom: 20px;
  float: right;
}
</style>
