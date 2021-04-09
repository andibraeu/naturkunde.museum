import { createApp } from 'vue'
import App from './App.vue'
import PrimeVue from 'primevue/config';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';

import 'primevue/resources/themes/mdc-light-indigo/theme.css';
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';

createApp(App)
  .use(PrimeVue)
  .component('DataTable', DataTable)
  .component('Column', Column)
  .component('Button', Button)
  .mount('#app')
