<template>
  <div class="report-brinfinite">
    <canvas id="mycanvas2" count="2"></canvas>

    <chartjs-bar target="mycanvas2"
    :labels="meses"
    :datalabel="row.seguradora"
    :data="row.valores"
    v-for="(row, index) in this.dados"
    v-bind:key="index">
    </chartjs-bar>


</div>
</div>
</template>

<script>
export default {
  props:['dados'],
  data(){
    return {
      meses : ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
      data : [50, 90, 50, 90, 50, 90, 50, 100, 40, 232, 40, 567]
    }
  },
  methods: {

  },
  mounted() {

  }
}
</script>
