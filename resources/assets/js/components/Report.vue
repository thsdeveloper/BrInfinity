<template>
  <div class="report-brinfinite">
    <canvas id="mycanvas2" count="1"></canvas>
    <chartjs-bar target="mycanvas2" :labels="meses" :datalabel="index" :data="row.index" v-for="(row, index) in this.dados" v-bind:key="index"></chartjs-bar>

  </div>
</div>
</template>

<script>
export default {
  props:['dados'],
  data(){
    return {
      meses : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      data : [100, 40, 60, 100, 40, 60100, 40, 60100, 40, 60100, 40, 60100, 40, 60100, 40, 60]
    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
