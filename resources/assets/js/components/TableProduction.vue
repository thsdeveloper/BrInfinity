<template>
  <div class="tabel-producao" v-loading.fullscreen.lock="loading">

    <el-table style="width: 100%" :data="corretoras" border>

      <el-table-column  label="Corretoras" width="500">
        <template slot-scope="scope">
          <span style="margin-left: 10px">{{ scope.row.name }}</span>
        </template>
      </el-table-column>


      <el-table-column  :label="s.name" v-for="s in seguradoras" :key="s.id">
        <template slot-scope="scope">
          <div v-for="p in producoes" :key="p.id" v-if="p.seguradora_id === s.id && p.corretora_id === scope.row.id" style="text-align: center">
            <el-button type="text" @click="addProduction(p)">R$ {{p.total}}</el-button>
          </div>
        </template>
      </el-table-column>

    </el-table>

    <el-dialog title="Adicionar nova produção" :visible.sync="dialogVisible" width="40%">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm" class="demo-ruleForm">
        <el-row :gutter="20">
          <el-col :span="12">
            <el-form-item prop="data">
              <el-date-picker type="date" placeholder="Data da produção" v-model="ruleForm.data"></el-date-picker>
            </el-form-item>
          </el-col>
          <el-col :span="12">
            <el-form-item prop="acumulado">
              <el-input v-model.number="ruleForm.acumulado" placeholder="Valor acumulado"></el-input>
            </el-form-item>
          </el-col>
          <el-col :span="24">
            <el-table :data="tableData" style="width: 100%">
              <el-table-column label="Data">
                <template slot-scope="scope">
                  <span><i class="fas fa-calendar-alt"></i> {{ scope.row.created_at | moment("dddd, D MMMM YYYY")}}</span>
                </template>

              </el-table-column>
              <el-table-column label="Valor Acumulado">
                <template slot-scope="scope">
                  <span style="margin-left: 10px">R$ {{ scope.row.valor }}</span>
                </template>
              </el-table-column>
              <el-table-column>
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
      idIntermediation: null,
      loading: false,
      tableData: [],

      ruleForm: {
        data: '',
        acumulado: ''
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
      _this.loading = true;
      _this.$refs[formName].validate((valid) => {
        if (valid) {
          axios.post('insert/productivities', {
            id: _this.idIntermediation,
            data: _this.ruleForm.data,
            valor: _this.ruleForm.acumulado,
          })
          .then(function (r) {
            _this.loading = false;
            _this.tableData.push({id: r.id, intermediation_id: r.intermediation_id, valor: r.valor, created_at: r.created_at});
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
      _this.loading = true;
      _this.$confirm('Deseja excluir o registro?', 'Atenção!', {
        confirmButtonText: 'Excluir',
        cancelButtonText: 'Cancelar',
        type: 'warning'
      }).then(() => {

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
</style>
