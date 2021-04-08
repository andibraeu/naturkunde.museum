import { createApp } from 'vue'
import App from './App.vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas, faSquare, faPhone, faPaperPlane } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter } from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon, FontAwesomeLayers } from '@fortawesome/vue-fontawesome'
import PrimeVue from 'primevue/config';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

import 'primevue/resources/themes/mdc-light-indigo/theme.css';
import 'primeicons/primeicons.css';
import 'primevue/resources/primevue.min.css';

library.add(faPhone, faPaperPlane, faSquare, fas, faFacebookF, faTwitter)

createApp(App)
  .use(PrimeVue)
  .component('fa', FontAwesomeIcon)
  .component('fa-layers', FontAwesomeLayers)
  .component('DataTable', DataTable)
  .component('Column', Column)
  .mount('#app')
