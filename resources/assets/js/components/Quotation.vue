<template>
  <div class="quotation-brinfinity">
    <el-row>
      <el-col :span="24">
        <a href="downloadCotacao/xls">
          <el-button type="primary" plain size="mini"><i class="fas fa-download"></i> Excel xls</el-button>
        </a>
        <a href="downloadCotacao/xlsx">
          <el-button type="primary" plain size="mini"><i class="fas fa-download"></i> Excel xlsx</el-button>
        </a>
        <a href="downloadCotacao/csv">
          <el-button type="primary" plain size="mini"><i class="fas fa-download"></i> Excel CSV</el-button>
        </a>
      </el-col>
      <el-col :span="24">
        <data-tables :data="this.cotacoes" style="width: 100%" :show-action-bar="false" :custom-filters="customFilters">
          <el-row slot="custom-tool-bar" style="margin-bottom: 20px; margin-top: 20px" :gutter="20">
            <el-col :span="6">
              <el-select v-model="customFilters[1].vals" placeholder="Selecione uma data">
                <el-option label="Janeiro" value="1"></el-option>
                <el-option label="Fevereiro" value="2"></el-option>
                <el-option label="Março" value="3"></el-option>
                <el-option label="Abril" value="4"></el-option>
                <el-option label="Maio" value="5"></el-option>
                <el-option label="Junho" value="6"></el-option>
                <el-option label="Julho" value="7"></el-option>
                <el-option label="Agosto" value="8"></el-option>
                <el-option label="Setembro" value="9"></el-option>
                <el-option label="Outubro" value="10"></el-option>
                <el-option label="Novembro" value="11"></el-option>
                <el-option label="Dezembro" value="12"></el-option>
              </el-select>
            </el-col>
            <el-col :span="14">
              <el-input v-model="customFilters[0].vals" placeholder="Digite o nome do proponente"></el-input>
            </el-col>
            <el-col :span="4">
              <el-button type="success" class="pull-right" @click="dialogCotacao = true"><i class="fas fa-plus"></i> Nova cotação</el-button>
            </el-col>
          </el-row>

          <el-table-column type="expand">
            <template slot-scope="props">
              <h3>Informações detalhadas:</h3>
              <p>Descrição: {{ props.row.descricao }}</p>
              <p>CPF/CNPJ: {{ props.row.cpf }}</p>
              <p>Corretora: {{ props.row.corretora.name }}</p>
              <p>Email da Corretora: {{ props.row.corretora.email }}</p>
              <p>Ramo: {{ props.row.ramo}}</p>
              <p>Seguradora: {{ props.row.seguradora.name}}</p>
            </template>
          </el-table-column>

          <el-table-column prop="data_solicitacao" label="Data da solicitação" sortable width="180"></el-table-column>
          <!-- <el-table-column prop="corretora.name" label="Corretora" width="300" sortable></el-table-column>
          <el-table-column prop="user.name" label="Gerente Comercial" sortable></el-table-column> -->
          <el-table-column prop="proponent" label="Proponente" sortable></el-table-column>
          <!-- <el-table-column prop="ramo" label="Ramo" sortable></el-table-column>
          <el-table-column prop="data_validade" label="Prazo (dias)" sortable></el-table-column> -->

          <el-table-column prop="data_validade" label="Status da cotação" width="250" sortable>

            <template slot-scope="scope">

              <el-tag type="info" v-if="scope.row.status === 0">Em negociação</el-tag>
              <el-tooltip class="item" effect="dark" content="Definir como fechado" placement="top" v-if="scope.row.status === 0">
                <el-button icon="el-icon-check" size="mini" @click="handleConfirmed(scope.$index, scope.row)"></el-button>
              </el-tooltip>
              <el-tooltip class="item" effect="dark" content="Definir como não fechado" placement="top" v-if="scope.row.status === 0">
                <el-button icon="el-icon-circle-close-outline" size="mini" @click="handleNoConfirmed(scope.$index, scope.row)"></el-button>
              </el-tooltip>

              <el-tooltip class="item" effect="dark" :content="scope.row.text_status" placement="top" v-if="scope.row.status === 1">
                <el-tag type="success" v-if="scope.row.status == 1">Cotação Fechada</el-tag>
              </el-tooltip>
              <el-tooltip class="item" effect="dark" content="Definir como: 'Em negociação'" placement="top" v-if="scope.row.status === 1">
                <el-button icon="el-icon-refresh" size="mini" @click="handleNegociacao(scope.$index, scope.row)"></el-button>
              </el-tooltip>


              <el-tooltip class="item" effect="dark" :content="scope.row.text_status" placement="top" v-if="scope.row.status === 2">
                <el-tag type="danger" v-if="scope.row.status == 2">Não fechado</el-tag>
              </el-tooltip>
              <el-tooltip class="item" effect="dark" content="Definir como: 'Em negociação'" placement="top" v-if="scope.row.status === 2">
                <el-button icon="el-icon-refresh" size="mini" @click="handleNegociacao(scope.$index, scope.row)"></el-button>
              </el-tooltip>

            </template>

          </el-table-column>

          <el-table-column fixed="right" label="Operações" width="220">
            <template slot-scope="scope">
              <el-button type="primary" plain size="small" icon="el-icon-edit" @click="editCotacao(scope.$index, scope.row)">Editar</el-button>
              <el-button type="danger" plain size="small" icon="el-icon-delete" @click="handleDelete(scope.$index, scope.row.id)">Excluir</el-button>
            </template>
          </el-table-column>
        </data-tables>

        <el-dialog title="Cadastrar nova cotação" :visible.sync="dialogCotacao" width="60%" :before-close="handleClose">
          <el-form :model="ruleForm" :rules="rules" ref="ruleForm">

            <el-row :gutter="20">
              <el-col :span="6">
                <el-form-item prop="data_solicitacao">
                  <el-date-picker v-model="ruleForm.data_solicitacao" type="date" value-format="yyyy-MM-dd" placeholder="Data da solicitação"></el-date-picker>
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
                <el-form-item prop="ramo">
                  <el-input v-model="ruleForm.ramo" placeholder="Ramo"></el-input>
                </el-form-item>
              </el-col>

              <el-col :span="8">
                <el-form-item prop="descricao">
                  <el-input v-model="ruleForm.descricao" placeholder="Descrição"></el-input>
                </el-form-item>
              </el-col>

              <el-col :span="8">
                <el-form-item prop="negocio">
                  <el-select v-model="ruleForm.negocio" placeholder="Tipo de negócio" class="mold-input-select">
                    <el-option label="Seguro Novo" value="1"></el-option>
                    <el-option label="Renovação" value="2"></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20" v-show="ruleForm.negocio == '2'">
              <el-col :span="6">
                <el-form-item prop="data_validade">
                  <el-date-picker v-model="ruleForm.data_validade" type="date" value-format="yyyy-MM-dd" placeholder="Data da vigência"></el-date-picker>
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item prop="congenere">
                  <el-input v-model="ruleForm.congenere" placeholder="Congenere"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item prop="last_valor">
                  <el-input v-model="ruleForm.last_valor" placeholder="Preço pago ano Passado"></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="6">
                <el-form-item prop="comissao">
                  <el-input v-model="ruleForm.comissao" placeholder="Comissão"></el-input>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <el-col :span="12">
                <el-form-item prop="seguradora_id">
                  <el-select v-model="ruleForm.seguradora_id" placeholder="Seguradora" class="mold-input-select">
                    <el-option v-for="item in this.seguradoras" :key="item.id" :label="item.name" :value="item.id"></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
              <el-col :span="12">
                <el-form-item prop="valor">
                  <el-input v-model="ruleForm.valor" placeholder="Preço BR Infinite"></el-input>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <el-col :span="24">
                <el-form-item prop="corretora_id">
                  <el-select v-model="ruleForm.corretora_id" placeholder="Corretora" class="mold-input-select">
                    <el-option v-for="item in this.corretoras" :key="item.id" :label="item.name" :value="item.id"></el-option>
                  </el-select>
                </el-form-item>
              </el-col>
            </el-row>

            <el-row :gutter="20">
              <el-col :span="24">
                <el-form-item>
                  <el-button type="primary" @click="submitForm('ruleForm')" v-loading.fullscreen.lock="fullscreenLoading" element-loading-text="Aguarde! Estamos atualizando...">Salvar</el-button>
                  <el-button @click="resetForm('ruleForm')">Limpar</el-button>
                </el-form-item>
              </el-col>
            </el-row>


          </el-form>
        </el-dialog>

        <el-dialog title="Status da cotação" :visible.sync="dialogStatus" width="40%">
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
                </el-form-item>
              </el-col>
            </el-row>
          </el-form>
        </el-dialog>

      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  props:['cotacoes', 'corretoras', 'seguradoras', 'user'],
  data(){
    return {
      //Filter Tbale
      customFilters: [{vals: '', props: 'proponent'}, {vals: '', props: 'data_solicitacao'}],

      meses: [{
        value: 'Option1',
        label: 'Janeiro'
      }, {
        value: 'Option2',
        label: 'Fevereiro'
      }, {
        value: 'Option3',
        label: 'Março'
      }, {
        value: 'Option4',
        label: 'Abril'
      }, {
        value: 'Option5',
        label: 'Maio'
      }],

      //Modal Dialog
      dialogCotacao: false,
      dialogStatus: false,

      //Id da Quotacao
      idQ: '',
      idStatus: '',

      //Loading
      fullscreenLoading: false,

      //Campos input-group
      ruleForm: {
        data_solicitacao: '',
        proponent: '',
        cpf: '',
        ramo: '',
        descricao: '',
        negocio: '',
        seguradora_id: '',
        valor: '',
        id_corretora: '',

        //Campos para update
        data_validade: '',
        congenere: '',
        last_valor: '',
        comissao: '',
        arquivo: '',
      },

      ruleFormStatus:{
        text_status: ''
      },
      rules: {
        data_solicitacao: [
          { required: true, message: 'Selecione a data da solicitação', trigger: 'blur' },
        ],
        proponent: [
          { required: true, message: 'Escreva o nome do proponente', trigger: 'blur' },
        ],
        cpf: [
          { required: true, message: 'Digite um CPF ou CNPJ', min: 11, max: 14, message: 'Mínimo de 11(CPF) e máximo de 14(CNPJ)', trigger: 'blur' },
        ],
        ramo: [
          { required: true, message: 'Digite um ramo de atuação', trigger: 'blur' },
        ],
        descricao: [
          { required: true, message: 'Digite uma descrição', trigger: 'blur' },
        ],
        negocio: [
          { required: true, message: 'Escolha um tipo de negócio', trigger: 'blur' },
        ],
        seguradora_id: [
          { required: true, message: 'Escolha uma seguradora', trigger: 'blur' },
        ],
        valor: [
          { required: true, message: 'Insira um valor de negociação', trigger: 'blur' },
        ],
        id_corretora: [
          { required: true, message: 'Escolha uma corretora', trigger: 'blur' },
        ],
        text_status: [
          { required: true, message: 'Escreva uma justificativa', trigger: 'blur' },
        ],
      }
    }
  },

  filters: {

  },
  methods: {
    onFileChange(e) {
      console.log(e);
    },
    editCotacao(index, row){
      var _this = this;

      this.idQ = row.id;
      this.idStatus = row.status;

      _this.dialogCotacao = true;


      _this.ruleForm.data_solicitacao = row.data_solicitacao;
      _this.ruleForm.proponent = row.proponent;
      _this.ruleForm.cpf = row.cpf;
      _this.ruleForm.ramo = row.ramo;
      _this.ruleForm.descricao = row.descricao;
      _this.ruleForm.negocio = row.negocio;
      _this.ruleForm.seguradora_id = row.seguradora_id;
      _this.ruleForm.valor = row.valor;
      _this.ruleForm.corretora_id = row.corretora_id;

      //Update
      _this.ruleForm.data_validade = row.data_validade;
      _this.ruleForm.congenere = row.congenere;
      _this.ruleForm.last_valor = row.last_valor;
      _this.ruleForm.comissao = row.comissao;

    },
    handleConfirmed(index, row){
      this.dialogStatus = true;
      this.idQ = row.id;
      this.idStatus = 1;
    },
    handleNoConfirmed(index, row){
      this.dialogStatus = true;
      this.idQ = row.id;
      this.idStatus = 2;
    },
    handleNegociacao(index, row){
      this.dialogStatus = true;
      this.idQ = row.id;
      this.idStatus = 0;
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
          window.location.href = "/cotacao";
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

            axios.post('update/quotation/status', {
              id: _this.idQ,
              text_status: this.ruleFormStatus.text_status,
              status: this.idStatus,
            }).then(function (response) {
              _this.fullscreenLoading = false;
              window.location.href = "/cotacao";
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
    submitForm(formName, update) {
      var _this = this;

      this.$refs[formName].validate((valid) => {
        if (valid) {

          _this.dialogCotacao = false;
          _this.fullscreenLoading = true;
          setTimeout(() => {

            if(update === false){
              axios.post('insert/quotation', {
                data_solicitacao: this.ruleForm.data_solicitacao,
                proponent: this.ruleForm.proponent,
                cpf: this.ruleForm.cpf,
                ramo: this.ruleForm.ramo,
                descricao: this.ruleForm.descricao,
                negocio: this.ruleForm.negocio,
                valor: this.ruleForm.valor,
                seguradora_id: this.ruleForm.seguradora_id,
                corretora_id: this.ruleForm.corretora_id,
              }).then(function (response) {
                _this.fullscreenLoading = false;
                window.location.href = "/cotacao";
                console.log(response);
              }).catch(function (error) {
                console.log(error);
              });
            }else{
              axios.post('update/quotation/', {
                idQ: _this.idQ,
                data_solicitacao: this.ruleForm.data_solicitacao,
                proponent: this.ruleForm.proponent,
                cpf: this.ruleForm.cpf,
                ramo: this.ruleForm.ramo,
                descricao: this.ruleForm.descricao,
                negocio: this.ruleForm.negocio,
                valor: this.ruleForm.valor,
                seguradora_id: this.ruleForm.seguradora_id,
                corretora_id: this.ruleForm.corretora_id,

                //update
                data_validade: this.ruleForm.data_validade,
                congenere: this.ruleForm.congenere,
                last_valor: this.ruleForm.last_valor,
                comissao: this.ruleForm.comissao,
                arquivo: this.ruleForm.arquivo,

              }).then(function (response) {
                _this.fullscreenLoading = false;
                window.location.href = "/cotacao";
                console.log(response);
              }).catch(function (error) {
                console.log(error);
              });
            }

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
.el-select {
  width: 100%;
}
input.el-upload__input {
  display: none;
}
span.caret-wrapper {
  display: none!important;
}
</style>
