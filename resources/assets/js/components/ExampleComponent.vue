<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">{{this.name}}</div>

          <div class="panel-body">
            I'm an example component!dsfdsfsadsdss
            <el-button type="text" @click="dialogVisible = true">click to open the Dialog</el-button>
          </div>

          <el-dialog
          title="Tips"
          :visible.sync="dialogVisible"
          width="30%"
          :before-close="handleClose">
          <span>This is a message</span>
          <span slot="footer" class="dialog-footer">
            <el-button @click="dialogVisible = false">Cancel</el-button>
            <el-button type="primary" @click="buscaUser()">Confirm</el-button>
          </span>
        </el-dialog>


      </div>
    </div>
  </div>
</div>
</template>

<script>
export default {
  data(){
    return {
      name: '',
      dialogVisible: false,
    }
  },
  methods: {
    handleClose(){
      alert('modal fechou!')
    },
    buscaUser(){
      alert('Buscar user')
    }
  },
  mounted() {
    var _this = this;

    axios.get('/gerenciador/user/1')
    .then(function (response) {
      console.log(response.data);

      _this.name = response.data;

    })
    .catch(function (error) {
      console.log(error);
    });
  }
}
</script>
