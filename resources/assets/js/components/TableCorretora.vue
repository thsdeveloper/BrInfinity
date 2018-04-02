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


    <el-table :data="this.data" style="width: 100%">
      <el-table-column prop="name" label="Corretoras"></el-table-column>
      <el-table-column label="Ações">
        <template slot-scope="scope">
          <el-button size="mini" @click="editarCorretora(scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
          <el-button size="mini" type="danger" @click="deletarCorretora(scope.row.id)"><i class="fas fa-trash"></i> Excluir</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
export default {
  props:['data', 'users', 'seguradoras'],
  data(){
    return {
      options: [{
        value: 'Option1',
        label: 'Option1'
      }, {
        value: 'Option2',
        label: 'Option2'
      }, {
        value: 'Option3',
        label: 'Option3'
      }, {
        value: 'Option4',
        label: 'Option4'
      }, {
        value: 'Option5',
        label: 'Option5'
      }],

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
        seguradora: null
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
    insert(){

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
      axios.post('corretora/atualizar/'+this.idAtualizacao, {
        name: this.formCorretora.name,
        cnpj: this.formCorretora.cnpj,
        telefone: this.formCorretora.telefone,
        email: this.formCorretora.email,
        endereco: this.formCorretora.endereco,
      })
      .then(function (response) {
        window.location.href = "/corretoras";
        console.log(response);
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    deletarCorretora(id){
      axios.post('corretora/deletar/'+id)
      .then(function (response) {
        window.location.href = "/corretoras";
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
.table-corretora .btn-cadastrar{
  margin-bottom: 20px;
  float: right;
}
</style>
