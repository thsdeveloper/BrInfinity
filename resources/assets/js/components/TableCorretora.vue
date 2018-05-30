<template>
  <div class="table-corretora" v-loading.fullscreen.lock="loading">

    <data-tables :data="this.dadosCorretoras"  :custom-filters="customFilters" :show-action-bar="false" style="width: 100%">
      <el-row slot="custom-tool-bar" style="margin-bottom: 20px; margin-top: 20px" :gutter="20">
        <el-col :span="20">
          <el-input v-model="customFilters[0].vals" placeholder="Digite o nome da corretora"></el-input>
        </el-col>
        <el-col :span="4">
          <el-button type="success" class="btn-cadastrar" @click="dialogCadastro = true"><i class="fas fa-plus"></i> Cadastrar corretora</el-button>
        </el-col>
      </el-row>
      <el-table-column prop="name" label="Corretoras"></el-table-column>
      <el-table-column prop="cnpj" label="CNPJ"></el-table-column>
      <el-table-column prop="phone" label="Telefone"></el-table-column>
      <el-table-column prop="email" label="Email"></el-table-column>
      <el-table-column label="Ações">
        <template slot-scope="scope">
          <el-button size="mini" @click="editarCorretora(scope.row)"><i class="fas fa-edit"></i> Editar</el-button>
          <el-button size="mini" type="danger" @click="deletarCorretora(scope.row.id, scope.$index)"><i class="fas fa-trash"></i> Excluir</el-button>
        </template>
      </el-table-column>
    </data-tables>


    <el-dialog title="Cadastrar nova corretora" :visible.sync="dialogCadastro" width="50%">
      <el-form :model="formCorretora" :rules="rules" ref="ruleForm">
        <el-row :gutter="20">
          <el-col :span="12">
            <el-form-item prop="name">
              <el-input v-model="formCorretora.name" placeholder="Nome da corretora"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item prop="cnpj">
              <el-input v-model="formCorretora.cnpj" v-mask="'##.###.###/####-##'" placeholder="CNPJ"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="12">
            <el-form-item prop="telefone">
              <el-input v-model="formCorretora.telefone" v-mask="'(##) ####-####', '(##) #####-####'" placeholder="Telefone"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item prop="email">
              <el-input v-model="formCorretora.email" placeholder="Email"></el-input>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="12">
            <el-form-item prop="endereco">
              <el-input v-model="formCorretora.endereco" placeholder="Endereço"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item prop="seguradora">
              <el-select v-model="formCorretora.seguradora" multiple placeholder="Escolha as seguradoras" class="select-seguradoras">
                <el-option v-for="seg in seguradoras" :key="seg.id" :label="seg.name" :value="seg.id"></el-option>
              </el-select>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row :gutter="20">
          <el-col :span="24">
            <el-form-item>
              <el-button type="primary" @click="submitForm('ruleForm')">Cadastrar corretora</el-button>
              <el-button @click="resetForm('ruleForm')">Limpar dados</el-button>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </el-dialog>

    <el-dialog title="Cadastrar nova corretora" :visible.sync="dialogAtualizar" width="50%">

      <el-form :model="formCorretora" :rules="rules" ref="ruleForm">
        <el-form-item prop="name">
          <el-input v-model="formCorretora.name" placeholder="Nome da corretora"></el-input>
        </el-form-item>
        <el-form-item prop="cnpj">
          <el-input v-model="formCorretora.cnpj" v-mask="'##.###.###/####-##'" placeholder="CNPJ"></el-input>
        </el-form-item>
        <el-form-item prop="telefone">
          <el-input v-model="formCorretora.telefone" v-mask="'(##) ####-####', '(##) #####-####'" placeholder="Telefone"></el-input>
        </el-form-item>
        <el-form-item prop="email">
          <el-input v-model="formCorretora.email" placeholder="Email"></el-input>
        </el-form-item>
        <el-form-item prop="endereco">
          <el-input v-model="formCorretora.endereco" placeholder="Endereço"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="atualizar()">Atualizar corretora</el-button>
        </el-form-item>
      </el-form>
    </el-dialog>

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
      loading: false,
      formCorretora: {
        name: null,
        cnpj: null,
        telefone: null,
        email: null,
        endereco: null,
        comercial: null,
        seguradora: []
      },
      //Filter Tbale
      customFilters: [{vals: '', props: 'name'}],

      rules: {
        name: [
          { required: true, message: 'O nome da corretora é obrigatório.', trigger: 'blur' },
        ],
        cnpj: [
          { required: true, message: 'Insira um CNPJ válido', trigger: 'blur' },
        ],
        telefone: [
          { required: true, message: 'Insira um telefone válido', trigger: 'blur' },
        ],
        email: [
          { required: true, message: 'Insira um email válido', trigger: 'blur' },
        ],
        endereco: [
          { required: true, message: 'Insira um endereço válido', trigger: 'blur' },
        ],
        seguradora: [
          { required: true, message: 'Escolha as seguradoras relacionadas', trigger: 'blur' },
        ],
      }
    }
  },
  methods: {
    submitForm(formName) {
      var _this = this;
      _this.$refs[formName].validate((valid) => {
        if (valid) {
          _this.loading = true;
          axios.post('corretora/inserir', {
            name: _this.formCorretora.name,
            cnpj: _this.formCorretora.cnpj,
            telefone: _this.formCorretora.telefone,
            email: _this.formCorretora.email,
            endereco: _this.formCorretora.endereco,
            seguradora: _this.formCorretora.seguradora
          })
          .then(function (r) {
            _this.loading = false;
            _this.dialogCadastro = false;
            _this.dadosCorretoras.push({address: r.data.address, cnpj: r.data.cnpj, created_at: r.data.created_at, email: r.data.email, id: r.data.id, name: r.data.name, phone: r.data.phone, updated_at: r.data.updated_at});
            _this.$message({
              message: 'Corretora inserida com sucesso!',
              type: 'success'
            });
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
      var _this = this;
      axios.post('corretora/atualizar/',{
        id: this.idAtualizacao,
        name: this.formCorretora.name,
        cnpj: this.formCorretora.cnpj,
        telefone: this.formCorretora.telefone,
        email: this.formCorretora.email,
        endereco: this.formCorretora.endereco,
      })
      .then(function (r) {
        _this.loading = false;
        _this.dialogAtualizar = false;
        _this.dadosCorretoras.push({address: r.data.address, cnpj: r.data.cnpj, created_at: r.data.created_at, email: r.data.email, id: r.data.id, name: r.data.name, phone: r.data.phone, updated_at: r.data.updated_at});
        _this.$message({
          message: 'Corretora atualizada com sucesso!',
          type: 'success'
        });
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
.table-corretora .el-select.selectMold {
  width: 100%;
}
.table-corretora .el-select.select-seguradoras {
    width: 100%;
}
</style>
