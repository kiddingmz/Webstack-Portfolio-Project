<template>
  <HeaderComponent/>
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="col-auto pt-3">
        <h1 class="app-page-title">Add Medical Prescription</h1>
      </div>
        <form
            novalidate
            @submit.prevent="createCorrespondence()"
            >
          <div class="row g-4 mb-4">
            <div class="col-12 col-md-12">
              <div class="app-card app-card-stats-table h-100 shadow-sm">
                <div class="mb-3 row">
                  <div class="col-12 col-md-12">
                    <div class="app-card app-card-settings shadow-sm p-4">
                      <div class="app-card-body">
                          <div class="row g-4 mb-4 section">
                            <div class="col-12 col-md-12">
                              <div class="app-card app-card-stats-table h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                  <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                      <h4 class="app-card-title">Entry</h4>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-md-12">
                                  <div class="app-card app-card-settings shadow p-4">
                                    <div class="app-card-body">
                                      <div class="mb-3 row">
                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Order Number: <small class="text-danger"><strong>*</strong></small></label>
                                          <input
                                              name="order_number"
                                              type="text"
                                              class="form-control"
                                              v-model="order_number"
                                          >
                                        </div>
                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label
                                              class="form-label">Entry date: <small class="text-danger"><strong>*</strong></small></label>
<!--                                          <ErrorMessage name="email" />-->

<!--                                          <Field name="email" type="email" />-->
                                          <input
                                              name="year"
                                              type="date"
                                              class="form-control"
                                              v-model="year"
                                          >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row g-4 mb-4 section">
                            <div class="col-12 col-md-12">
                              <div class="app-card app-card-stats-table h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                  <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                      <h4 class="app-card-title">Document Reference</h4>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-12 col-md-12">
                                  <div class="app-card app-card-settings shadow p-4">
                                    <div class="app-card-body">
                                      <div class="mb-3 row">
                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label class="form-label">Number: <small class="text-danger"><strong>*</strong></small></label>
                                          <input
                                              name="reference_number"
                                              type="text"
                                              class="form-control bg-white"
                                              v-model="reference_number"
                                          >
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Provenance: <small class="text-danger"><strong>*</strong></small></label>
                                          <input
                                              name="provenance"
                                              type="text"
                                              class="form-control bg-white"
                                              v-model="provenance"
                                          >
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Classification Code: <small class="text-danger"><strong>*</strong></small></label>
                                          <input
                                              name="classification_code"
                                              type="text"
                                              class="form-control bg-white"
                                              v-model="classification_code"
                                          >
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Subject: <small class="text-danger"><strong>*</strong></small></label>
                                          <input
                                              name="subject"
                                              type="text"
                                              class="form-control bg-white"
                                              v-model="subject"
                                          >
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label class="form-label">Document Date <small class="text-danger"><strong>*</strong></small></label>
                                          <input
                                              name="doc_date"
                                              type="date"
                                              class="form-control bg-white"
                                              v-model="doc_date"
                                          >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="row g-4 mb-4 section">
                            <div class="col-12 col-md-12">
                              <div class="app-card app-card-stats-table h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                  <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                      <h4 class="app-card-title">Others</h4>
                                    </div>
                                    <div class="col-auto">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-12 col-md-12">
                                  <div class="app-card app-card-settings shadow p-4">
                                    <div class="app-card-body">
                                      <div class="mb-3 row">
                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Forwarded to: </label>
                                          <input
                                              name="forwarded_to"
                                              type="text"
                                              class="form-control bg-white"
                                              v-model="forwarded_to"
                                          >
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Dispatch: </label>
                                          <input
                                              name="dispatch"
                                              type="text"
                                              class="form-control bg-white"
                                              v-model="dispatch"
                                          >
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Observations: </label>
                                          <textarea
                                              rows="5"
                                              name="observition"
                                              class="form-control"
                                              v-model="observition"
                                          ></textarea>
                                        </div>

                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Attach document: </label>
                                          <input
                                              ref="file"
                                              accept="application/pdf"
                                              name="pdf_path"
                                              type="file"
                                              class="form-control"
                                              @change="handleFileUpload"
                                          >
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <button type="submit" class="btn app-btn-primary col-12 col-md-12" >Add medical prescription</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
</template>

<script>
// import $ from "jquery";
import axios from "axios";
// import {ValidationObserver, ValidationProvider} from "vee-validate";
// import { Form, Field, ErrorMessage} from 'vee-validate';
// import {Form} from 'vee-validate';
import 'sweetalert2/src/sweetalert2.scss'
import '@/assets/static/css/portal.css';
import HeaderComponent from "@/components/HeaderComponent.vue";
import baseURL from "@/services/api";
import Cookie from "@/services/cookie";

export default {
  name: 'CreateCorrespondencePage',
  components: {HeaderComponent},
  return: {
    data() {
      return {
          year: '',
          reference_number: '',
          provenance: '',
          classification_code: '',
          doc_date: '',
          subject: '',
          dispatch: '',
          observition: '',
          forwarded_to: '',
          pdf_path: '',
          order_number: ''
      }
    },
  },
  mounted() {
  },
  methods: {

    showAlert(msg, type, position= "top-end") {
      this.$swal({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: 3000,
        title: msg,
        icon: type,
      });
    },
    oldcreateCorrespondences: () => {
      const dataToSave = {
        year: this.year,
        reference_number: this.reference_number,
        provenance: this.provenance,
        classification_code: this.classification_code,
        doc_date: this.doc_date,
        subject: this.subject,
        dispatch: this.dispatch,
        observition: this.observition,
        forwarded_to: this.forwarded_to,
        pdf_path: this.pdf_path
      };

      // const dataToSave = {
      //   year: '2024-09-09',
      //   reference_number: '93299',
      //   provenance: 'Louco',
      //   classification_code: 8973,
      //   doc_date: '2023-10-10',
      //   subject: 'Dog',
      //   dispatch: 'Fill',
      //   observition: 'Good',
      //   forwarded_to: 'Home',
      // };

      const config = {
        url: `${baseURL}/correspondences`,
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${Cookie.getToken()}`,
        },
        data: dataToSave
      };

      axios(config)
          .then(response => {
            console.log('Correspondência criada com sucesso:', response.data);
          })
          .catch(error => {
            console.error('Erro ao criar a correspondência:', error);
          });
    },
    async createCorrespondence() {
      try {
        const formData = new FormData();
        formData.append('year', this.year === undefined ? '' : this.year);
        formData.append('reference_number', this.reference_number === undefined ? '' : this.reference_number);
        formData.append('provenance', this.provenance === undefined ? '' : this.provenance);
        formData.append('classification_code', this.classification_code === undefined ? '' : this.classification_code);
        formData.append('doc_date', this.doc_date === undefined ? '' : this.doc_date);
        formData.append('subject', this.subject  === undefined ? '' : this.subject);
        formData.append('dispatch', this.dispatch === undefined ? '' : this.dispatch);
        formData.append('observition', this.observition === undefined ? '' : this.observition);
        formData.append('forwarded_to', this.forwarded_to === undefined ? '' : this.forwarded_to);
        formData.append('destination', this.destination === undefined ? '' : this.destination);
        formData.append('order_number', this.order_number === undefined ? '' : this.order_number);

        if (this.pdf_path) {
          formData.append('pdf_path', this.pdf_path);
        }

        // console.log(...formData)
        const config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${Cookie.getToken()}`,
          }
        };
        const response = await axios.post(`${baseURL}/correspondences`, formData, config);

        if (response.status === 201) {
          this.showAlert('Medical prescription successfully created', 'success');
          const self = this;
          setTimeout(function() {
            self.$router.push({name: 'prescription'});
          }, 2400);
        }
      } catch (error) {
        if (error.response){
          if (error.response.status === 422){
            this.showAlert('Fill in all mandatory fields', 'warning');
          }else {
            this.showAlert('Error updating Correspondence', 'error');
          }
        }else if (error.request){
          this.showAlert('Sem resposta do servidor. Por favor, verifique sua conexão de internet.', 'error');
        } else {
          this.showAlert('Erro ao enviar solicitação. Por favor, tente novamente mais tarde.', 'error');
        }
      }
    },
    handleFileUpload() {
      this.pdf_path = this.$refs.file.files[0];
    },
  },
}
</script>

<style scoped>

</style>
