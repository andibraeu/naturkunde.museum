import { createApp } from 'vue'
import App from './App.vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas, faSquare, faPhone, faPaperPlane } from '@fortawesome/free-solid-svg-icons'
import { faFacebookF, faTwitter } from "@fortawesome/free-brands-svg-icons";
import { FontAwesomeIcon, FontAwesomeLayers } from '@fortawesome/vue-fontawesome'

library.add(faPhone, faPaperPlane, faSquare, fas, faFacebookF, faTwitter)

createApp(App)
  .component('fa', FontAwesomeIcon)
  .component('fa-layers', FontAwesomeLayers)
  .mount('#app')
