
/**
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/pt-br'
Vue.use(ElementUI, {locale})

import DataTables from 'vue-data-tables'
Vue.use(DataTables)
/**
* Next, we will create a fresh Vue application instance and attach it to
* the page. Then, you may begin adding components to this application
* or customize the JavaScript scaffolding to fit your unique needs.
*/
Vue.component('infinity-menu', require('./components/InfinityMenu.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('table-production', require('./components/TableProduction.vue'));

Vue.component('quotation-brinfinty', require('./components/Quotation.vue'));
Vue.component('report-brinfinty', require('./components/Report.vue'));
Vue.component('report-table', require('./components/ReportTable.vue'));
Vue.component('report-table-mensal', require('./components/ReportTableMensal.vue'));
Vue.component('table-seguradora', require('./components/TableSeguradora.vue'));
Vue.component('table-corretora', require('./components/TableCorretora.vue'));
Vue.component('table-users', require('./components/TableUsers.vue'));
Vue.component('table-configuracao', require('./components/TableConfiguracao.vue'));



const app = new Vue({
  el: '#app'
});
