import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import bootstrap from 'bootstrap/dist/css/bootstrap.min.css'
// import "datatables.net-bs4";
// import "datatables.net-bs4/css/dataTables.bootstrap4.min.css";
import "jszip";
import "pdfmake";
import "datatables.net-buttons-bs4";
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css";
import "datatables.net-buttons/js/buttons.colVis";
import "datatables.net-buttons/js/buttons.flash";
import "datatables.net-buttons/js/buttons.html5";
import "datatables.net-buttons/js/buttons.print";
// import DataTable from 'datatables.net-vue3';
// import DataTablesCore from 'datatables.net';
import "./assets/static/css/portal.css";
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css';
import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css';

// import 'datatables.net/js/jquery.dataTables.min.js';
import 'datatables.net-bs5/js/dataTables.bootstrap5.min.js';
// import 'datatables.net-buttons-bs5/js/dataTables.buttons.min.js';
import 'datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js';
// import 'datatables.net-responsive-bs5/js/dataTables.responsive.min.js';


// import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/src/sweetalert2.scss'


import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// DataTable.use(DataTablesCore);
const app = createApp(App);
app.use(store).use(router).use(bootstrap).use(VueSweetalert2);
app.mount('#app');
