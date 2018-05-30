<template>
  <div class="tabel-producao" v-loading.fullscreen.lock="loading">

    <data-tables style="width: 100%" :data="corretoras" border :show-action-bar="false" :custom-filters="customFilters">
      <el-row slot="custom-tool-bar" style="margin-bottom: 20px; margin-top: 20px" :gutter="20">
        <el-col :span="6">
          <el-select v-model="customFilters[1].vals" placeholder="Selecione uma data" class="selectMold">
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
          <el-input v-model="customFilters[0].vals" placeholder="Digite o nome da corretora"></el-input>
        </el-col>
        <el-col :span="4">
          <el-button type="success" class="pull-right" @click="dialogProducao = true"><i class="fas fa-plus"></i> Nova produção</el-button>
        </el-col>
      </el-row>

      <el-table-column  label="Corretoras" width="300">
        <template slot-scope="scope">
          <span style="margin-left: 10px">{{ scope.row.name }}</span>
        </template>
      </el-table-column>

      <el-table-column  :label="s.name" v-for="s in seguradoras" :key="s.id">
        <template slot-scope="scope">
          <div v-for="p in producoes" :key="p.id" v-if="p.seguradora_id === s.id && p.corretora_id === scope.row.id" style="text-align: center">
            <el-button type="text" @click="addProduction(p)">{{p.total | real}}</el-button>
          </div>
        </template>
      </el-table-column>

    </data-tables>

    <el-dialog title="Adicionar nova produção" :visible.sync="dialogVisible" width="50%">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm" class="demo-ruleForm">
        <el-row :gutter="20">
          <el-col :span="12">
            <el-form-item prop="data">
              <el-date-picker type="date" placeholder="Data da produção" v-model="ruleForm.data"  :picker-options="pickerOptions1"></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item prop="acumulado">
              <el-input v-model.number="ruleForm.acumulado" placeholder="Valor acumulado"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="24">
            <el-table :data="tableData" style="width: 100%">
              <el-table-column label="Data de entrada">
                <template slot-scope="scope">
                  <span><i class="fas fa-calendar-alt"></i> {{ scope.row.created_at | moment("dddd, D MMMM YYYY")}}</span>
                </template>

              </el-table-column>
              <el-table-column label="Valor Acumulado" width="180">
                <template slot-scope="scope">
                  <span style="margin-left: 10px" v-if="tableData.length > 1">{{ scope.row.valor | real }}</span>
                  <span style="margin-left: 10px" v-else><el-tag>Entrada inicial {{ scope.row.valor | real}}</el-tag></span>
                </template>
              </el-table-column>
              <el-table-column width="100px" v-if="tableData.length > 1">
                <template slot-scope="scope">
                  <el-tooltip class="item" effect="dark" content="Excluir este item?" placement="top">
                    <el-button size="mini" type="danger" @click="handleDelete(scope.$index, scope.row)"><i class="fas fa-trash"></i></el-button>
                  </el-tooltip>
                </template>
              </el-table-column>
            </el-table>
          </el-col>
          <el-col :span="24">
            <el-form-item class="mold-btn-dialog">
              <el-button type="primary" @click="submitForm('ruleForm')">Adicionar produção</el-button>
              <el-button @click="resetForm('ruleForm')">Limpar</el-button>
            </el-form-item>
          </el-col>
        </el-row>
      </el-form>
    </el-dialog>

  </div>
</template>

<script>
export default {
  props:['corretoras', 'seguradoras', 'producoes'],
  data(){
    return {
      dialogVisible: false,
      dialogProducao: false,
      idIntermediation: null,
      loading: false,
      tableData: [],

      //Filter Tbale
      customFilters: [{vals: '', props: 'proponent'}, {vals: '', props: 'data_solicitacao'}],

      ruleForm: {
        data: '',
        acumulado: ''
      },

      pickerOptions1: {
        disabledDate(time) {
          return time.getTime() > Date.now();
        },
      },

      rules: {
        acumulado: [
          { required: true, message: 'Valor acomulado', trigger: 'blur' },
          { type: 'number', message: 'Prencha um valor válido'}
        ],
        data: [
          {required: true, message: 'Escolha uma data', trigger: 'change' }
        ],
      }
    }
  },
  methods: {
    resetForm(formName) {
      this.$refs[formName].resetFields();
    },
    addProduction(item){
      var _this = this;
      _this.loading = true;
      _this.idIntermediation = item.intermediation_id;


      axios.post('list/productions/intermediation', {
        id: _this.idIntermediation,
      })
      .then(function (response) {
        _this.tableData = response.data;
        _this.loading = false;
        _this.dialogVisible = true;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    submitForm(formName) {
      var _this = this;
      _this.$refs[formName].validate((valid) => {
        if (valid) {
          _this.loading = true;
          axios.post('insert/productivities', {
            id: _this.idIntermediation,
            data: _this.ruleForm.data,
            valor: _this.ruleForm.acumulado,
          })
          .then(function (r) {
            console.log(r.data.valor);
            _this.loading = false;
            _this.tableData.push({id: r.data.id, intermediation_id: r.data.intermediation_id, valor: r.data.valor, created_at: r.data.created_at});
            _this.$message({type: 'success', message: 'Inserido com sucesso!'});
            console.log(r);
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
    handleDelete(index, row){
      var _this = this;
      _this.$confirm('Deseja excluir o registro?', 'Atenção!', {
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        type: 'warning'
      }).then(() => {
        _this.loading = true;
        axios.post('delete/productivities/'+row.id)
        .then(function (r) {
          _this.loading = false;
          _this.tableData.splice(index, 1);
          _this.$message({
            type: 'success',
            message: 'Excluído!'
          });
        }).catch(function (error) {
          console.log(error);
        });
      }).catch(() => {
        _this.loading = false;
        this.$message({
          type: 'info',
          message: 'Operação cancelada!'
        });
      });
    }
  },
  mounted() {
    console.log("Componente Table Montado");
  },
  filters: {
    real(value) {
      return  `R$ ${value}`;
    }
  },
  computed: {

  },
}
</script>
<style>
.tabel-producao .el-form-item.mold-btn-dialog {
  margin-top: 40px;
}
.tabel-producao .el-date-editor.el-input.el-input--prefix.el-input--suffix.el-date-editor--date {
  width: 100%;
}
.tabel-producao .el-select.selectMold {
  width: 100%;
}
</style>
