<template>
  <div class="tabel-producao">

    <div class="mold-button" v-show="dados.length !== 0">
      <el-button type="text" @click="dialogVisible = true">R$ {{this.valor}}</el-button>

      <el-dialog :title="'Produção: '+row.insurers_name+' - '+row.brokerages_name" :visible.sync="dialogVisible" width="50%" :before-close="handleClose" v-for="(row, index) in this.dados" v-bind:key="index">

        <el-form :model="ruleForm" :rules="rules" ref="ruleForm">
          <el-row :gutter="20">
            <el-col :span="12">
              <div class="block">

                <el-form-item prop="dateInput">
                  <el-date-picker
                  class="dateTimeInput"
                  v-model="ruleForm.dateInput"
                  type="date"
                  placeholder="Data do lançamento">
                </el-date-picker>
              </el-form-item>

            </div>
          </el-col>

          <el-col :span="12">

            <el-form-item prop="valorInput">
              <el-input placeholder="Insriva um valor acumulado" v-model="ruleForm.valorInput">
                <template slot="prepend">R$</template>
              </el-input>
            </el-form-item>

          </el-col>
        </el-row>

        <el-row>
          <el-table :data="dados" stripe style="width: 100%">
            <el-table-column prop="productivities_data" label="Data"></el-table-column>
            <el-table-column prop="productivities_value" label="Produção do dia"></el-table-column>
            <el-table-column prop="productivities_value" label="Acumulado"></el-table-column>
            <el-table-column
            fixed="right"
            label="Ações">
            <template slot-scope="scope">
              <el-button type="text" size="small" @click="excluirProductivities(row.id)" icon="el-icon-delete">Excluir</el-button>
            </template>
          </el-table-column>
        </el-table>
      </el-row>

      <el-row :gutter="20">
        <el-col :span="24" class="margin-button">
          <el-button @click="dialogVisible = false">Cancelar</el-button>
          <el-button type="primary" @click="submitForm()">Inserir produção</el-button>
        </el-col>
      </el-row>






    </el-form>
  </el-dialog>
</div>

<el-button type="text" disabled v-show="dados.length === 0">--</el-button>

</div>
</template>

<script>
export default {
  props:['intermediations', 'valor'],
  data(){
    return {
      dialogVisible: false,
      dados: [],

      //Dados forms
      ruleForm:{
        dateInput: '',
        valorInput: '',
      },

      //Validation rules
      rules: {
        dateInput: [
          { required: true, message: 'Insira uma data para continuar', trigger: 'blur' },
        ],
        valorInput: [
          { required: true, message: 'Insira um valor', trigger: 'blur' },
        ],
      },
    }
  },
  methods: {
    excluirProductivities(id){
      var _this = this;
      console.log('Id da Pro:'+id);
      this.$confirm('Deseja realmente excluir este registro?', 'Excluir este registro?', {
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        type: 'info'
      }).then(() => {
        //Deletar os registros
        axios.post('delete/productivities/'+id).then(function (response) {
          console.log('Retorno do delete: '+response.data);
          _this.$message({
            type: 'success',
            message: 'Registro deletado com sucesso!'
          });
          window.location.href = "/gerenciador/producao";
        }).catch(function (error) {
          console.log(error);
        });
      }).catch(() => {
        _this.$message({
          type: 'info',
          message: 'Operação cancelada!'
        });
      });
    },
    submitForm() {
      console.log('Inserir no banco: '+this.intermediations);
      console.log('Data: '+this.ruleForm.dateInput);
      console.log('Valor: '+this.ruleForm.valorInput);

      axios.post('insert/productivities', {
        id: this.intermediations,
        data: this.ruleForm.dateInput,
        valor: this.ruleForm.valorInput,
      }).then(function (response) {
        window.location.href = "/gerenciador/producao";
        console.log('Retorno do insert: '+response.data);
      })
      .catch(function (error) {
        console.log(error);
      });


    },
    handleClose(done) {
      this.$confirm('Deseja cancelar esta operação?')
      .then(_ => {
        done();
      })
      .catch(_ => {});
    }
  },
  mounted() {
    var _this = this;
    axios.get('producao/intermediacao/'+this.intermediations).then(function (response) {
      _this.dados = response.data;
    })
    .catch(function (error) {
      console.log(error);
    });

    console.log("Componente Table Montado");
  }
}
</script>

<style>
.el-date-editor.dateTimeInput.el-input.el-input--prefix.el-input--suffix.el-date-editor--date {
  width: 100%;
}
.margin-button.el-col.el-col-24 {
  margin-top: 20px;
}
</style>
