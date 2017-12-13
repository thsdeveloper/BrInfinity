<template>
  <div class="quotation-brinfinity">

    <div class="header">
      <div class="row">
        <div class="col-md-6">
          <h1>Cotação</h1>
        </div>
        <div class="col-md-6">
          <el-button type="primary" class="pull-right" icon="el-icon-circle-plus" @click="dialogQuotation = true">Nova cotação</el-button>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">

        <el-table :data="this.cotacao" style="width: 100%">
          <el-table-column type="expand">
            <template slot-scope="props">
              <h3>Informações detalhadas:</h3>
              <p>Data de Solicitação: {{ props.row.date_solicitation }}</p>
            </template>
          </el-table-column>

          <el-table-column prop="date_solicitation" label="Data da solicitação"></el-table-column>
          <el-table-column prop="brokerage.name" label="Corretora" width="300"></el-table-column>
          <el-table-column prop="user.name" label="Gerente Comercial"></el-table-column>
          <el-table-column prop="proponent" label="Proponente"></el-table-column>
          <el-table-column prop="industry" label="Ramo"></el-table-column>
          <el-table-column prop="validity" label="Prazo (dias)"></el-table-column>

          <el-table-column prop="validity" label="Status da cotação" width="250">
            <template slot-scope="scope">
              <el-tag type="info">Em negociação</el-tag>

              <el-tooltip class="item" effect="dark" content="Definir como fechado" placement="top">
                <el-button type="success" icon="el-icon-check" size="mini" @click="handleConfirmed(scope.$index, scope.row)"></el-button>
              </el-tooltip>
              <el-tooltip class="item" effect="dark" content="Definir como não fechado" placement="top">
                <el-button type="danger" icon="el-icon-circle-close-outline" size="mini" @click="handleConfirmed(scope.$index, scope.row)"></el-button>
              </el-tooltip>

            </template>
          </el-table-column>

          <el-table-column fixed="right" label="Operações" width="220">
            <template slot-scope="scope">
              <el-button type="primary" plain size="small" icon="el-icon-edit" @click="handleEdit(scope.$index, scope.row)">Editar</el-button>
              <el-button type="danger" plain size="small" icon="el-icon-delete" @click="handleDelete(scope.$index, scope.row.id)">Excluir</el-button>
            </template>
          </el-table-column>
        </el-table>

        <el-dialog title="Cadastrar nova cotação" :visible.sync="dialogQuotation" width="60%" :before-close="handleClose">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">

            <el-row :gutter="20">
              <el-col :span="6">
                <el-form-item prop="date_solicitation">
                  <el-date-picker v-model="ruleForm.date_solicitation" type="date" placeholder="Data da solicitação"></el-date-picker>
                </el-form-item>
              </el-col>
              <el-col :span="12">
                <el-form-item prop="proponent">
                  <el-input v-model="ruleForm.proponent" placeholder="Proponente"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item prop="cpf">
                  <el-input v-model="ruleForm.cpf" placeholder="CPF/CNPJ"></el-input>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <el-col :span="8">
                <el-form-item prop="industry">
                  <el-input v-model="ruleForm.industry" placeholder="Ramo"></el-input>
                </el-form-item>
              </el-col>

              <el-col :span="8">
                <el-form-item prop="description">
                  <el-input v-model="ruleForm.description" placeholder="Descrição"></el-input>
                </el-form-item>
              </el-col>

              <el-col :span="8">
                <el-form-item prop="id_business">
                  <el-select v-model="ruleForm.id_business" placeholder="Tipo de negócio" class="mold-input-select">
                    <el-option v-for="item in this.business" :key="item.id" :label="item.name" :value="item.id"></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item prop="id_insurer">
                  <el-select v-model="ruleForm.id_insurer" placeholder="Seguradora" class="mold-input-select">
                    <el-option v-for="item in this.insurer" :key="item.id" :label="item.name" :value="item.id"></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :span="12">
                <el-form-item prop="value">
                  <el-input v-model="ruleForm.value" placeholder="Preço BR Infinite"></el-input>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <el-col :span="24">
                <el-form-item prop="id_brokerage">
                  <el-select v-model="ruleForm.id_brokerage" placeholder="Corretora" class="mold-input-select">
                    <el-option v-for="item in this.brokerage" :key="item.id" :label="item.name" :value="item.id"></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row>



            <el-row :gutter="20">
              <el-col :span="24">
                <el-form-item>
                  <el-button type="primary" @click="submitForm('ruleForm')" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="Aguarde! Estamos salvando a nova cotação...">Salvar</el-button>
                  <el-button @click="resetForm('ruleForm')">Limpar</el-button>
                </el-form-item>
              </el-col>
            </el-row>



          </el-form>
        </el-dialog>

        <el-dialog title="Status da cotação" :visible.sync="dialogStatus" width="60%">
          <el-form :model="ruleFormStatus" :rules="rules" ref="ruleFormStatus">
            <el-row :gutter="20">
              <el-col :span="24">
                <el-form-item prop="text_status">
                  <el-input type="textarea" :rows="4" placeholder="Escreva uma justificativa" v-model="ruleFormStatus.text_status"></el-input>
                </el-form-item>
              </el-col>
            </el-row>
            <el-row :gutter="20">
              <el-col :span="24">
                <el-form-item>
                  <el-button type="primary" @click="submitFormStatus('ruleFormStatus')" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="Aguarde! Estamos salvando o status...">Salvar</el-button>
                  <el-button @click="resetForm('ruleForm')">Limpar</el-button>
                </el-form-item>
              </el-col>
            </el-row>
          </el-form>
        </el-dialog>

      </div>
    </div>
  </div>
</template>

<script>
export default {
  props:['cotacao', 'brokerage', 'business', 'insurer', 'user'],
  data(){
    return {
      //Modal Dialog
      dialogQuotation: false,
      dialogStatus: false,

      //Id da Quotacao
      idQ: '',

      //Loading
      fullscreenLoading: false,

      //Campos input-group
      ruleForm: {
        date_solicitation: '',
        proponent: '',
        cpf: '',
        industry: '',
        description: '',
        id_business: '',
        id_insurer: '',
        value: '',
        id_brokerage: '',
      },

      ruleFormStatus:{
        text_status: ''
      },
      rules: {
        date_solicitation: [
          { required: true, message: 'Selecione a data da solicitação', trigger: 'blur' },
        ],
        proponent: [
          { required: true, message: 'Escreva o nome do proponente', trigger: 'blur' },
        ],
        cpf: [
          { required: true, message: 'Digite um CPF ou CNPJ', min: 11, max: 14, message: 'Mínimo de 11(CPF) e máximo de 14(CNPJ)', trigger: 'blur' },
        ],
        industry: [
          { required: true, message: 'Digite um ramo de atuação', trigger: 'blur' },
        ],
        description: [
          { required: true, message: 'Digite uma descrição', trigger: 'blur' },
        ],
        id_business: [
          { required: true, message: 'Escolha um tipo de negócio', trigger: 'blur' },
        ],
        id_insurer: [
          { required: true, message: 'Escolha uma seguradora', trigger: 'blur' },
        ],
        value: [
          { required: true, message: 'Insira um valor de negociação', trigger: 'blur' },
        ],
        id_brokerage: [
          { required: true, message: 'Escolha uma construtora', trigger: 'blur' },
        ],
        text_status: [
          { required: true, message: 'Escreva uma justificativa', trigger: 'blur' },
        ],
      }
    }
  },
  methods: {
    handleConfirmed(index, row){
      this.dialogStatus = true;
      this.idQ = row.id;
    },
    handleDelete(index, id) {
      console.log(index, id);
      var _this = this;
      this.$confirm('Deseja excluir esta cotação?', 'Atenção', {
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        type: 'warning'
      }).then(() => {
        //Deletar os registros
        axios.post('delete/quotation/'+id).then(function (response) {
          console.log('Retorno do delete: '+response.data);
          _this.$message({
            type: 'success',
            message: 'Cotação excluída com sucesso!'
          });
          window.location.href = "/backend/cotacao";
        }).catch(function (error) {
          console.log(error);
        });
      }).catch(() => {
        _this.$message({
          type: 'info',
          message: 'Operação cancelada'
        });
      });
    },
    handleClose(done) {
      this.$confirm('Voçe pode perder todos os dados preenchidos no formulário, deseja continuar?', 'Deseja cancelar o cadastro?', {
        confirmButtonText: 'Sim',
        cancelButtonText: 'Cancelar',
        type: 'warning'
      }).then(() => {
        done();
      }).catch(() => {
        this.$message({
          type: 'info',
          message: 'Cadastro de cotação cancelado.'
        });
      });
    },
    submitFormStatus(formName){
      var _this = this;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          console.log(this.ruleForm);

          _this.fullscreenLoading = true;
          setTimeout(() => {

            axios.post('update/quotation/', {
              id: _this.idQ,
              text_status: this.ruleFormStatus.text_status,
              status: "2",
            }).then(function (response) {
              _this.fullscreenLoading = false;
              window.location.href = "/backend/cotacao";
              console.log(response);
            }).catch(function (error) {
              console.log(error);
            });
          }, 4000);
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    submitForm(formName) {
      var _this = this;
      this.$refs[formName].validate((valid) => {
        if (valid) {
          console.log(this.ruleForm);

          _this.fullscreenLoading = true;
          setTimeout(() => {

            axios.post('insert/quotation', {
              date_solicitation: this.ruleForm.date_solicitation,
              proponent: this.ruleForm.proponent,
              cpf: this.ruleForm.cpf,
              industry: this.ruleForm.industry,
              description: this.ruleForm.description,
              value: this.ruleForm.value,
              id_insurer: this.ruleForm.id_insurer,
              id_brokerage: this.ruleForm.id_brokerage,
              id_user: this.user.id,
              id_business: this.ruleForm.id_business,
            }).then(function (response) {
              _this.fullscreenLoading = false;
              window.location.href = "/backend/cotacao";
              console.log(response);
            }).catch(function (error) {
              console.log(error);
            });


          }, 4000);


        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  },
  mounted() {

  }
}
</script>
<style>
h1 {
  padding: 0;
  margin: 0;
}
.header{
  margin-bottom: 30px;
}
.el-select.mold-input-select {
  width: 100%;
}
</style>
