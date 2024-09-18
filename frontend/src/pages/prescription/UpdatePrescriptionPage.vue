<template>
  <HeaderComponent/>
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="col-auto pt-3">
        <h1 class="app-page-title">Updating medical prescription data</h1>
      </div>
          <form
              @submit.prevent="updateCorrespondence()"
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
                                              name="id"
                                              type="text"
                                              class="form-control"
                                              v-model="order_number"
                                          >
                                        </div>
                                        <div class="col-md-12 col-lg-6 mb-3">
                                          <label  class="form-label">Entry date: <small class="text-danger"><strong>*</strong></small></label>
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
                      <button type="submit" class="btn app-btn-primary col-12 col-md-12" >Update medical prescription</button>
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
  import $ from "jquery";
  import 'sweetalert2/src/sweetalert2.scss'
  import HeaderComponent from "@/components/HeaderComponent.vue";
  import baseURL from "@/services/api";
  import Cookie from "@/services/cookie";

export default {
  name: 'UpdateCorrespondencePage',
  components: {HeaderComponent},
  data() {
    return {
      correspondences: {},
      year: '',
      reference_number: '',
      provenance: '',
      classification_code: '',
      doc_date: '',
      subject: '',
      dispatch: '',
      observition: '',
      forwarded_to: '',
      correspondence_id: '',
      order_number: '',
    }
  },
  computed: {
    correspondences_id() {
      return this.$route.params.id;
    }
  },
  created() {
    this.getCorrespondences();
  },
  mounted() {

    // const self = this;
    // $(document).ready(() => {
    //   axios
    //       .get(`https://indg-api.edinte.com/api/correspondences/${this.correspondences_id}`)
    //       .then((response) => {
    //         this.correspondences = response.data.data;
    //         self.year = this.correspondences.year;
    //         console.log(this.correspondences);
    //       })
    //       .catch((error) => console.log(error.response));
    // })
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
    getCorrespondences() {
      axios.get(`${baseURL}/correspondences/${this.correspondences_id}`, {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${Cookie.getToken()}`,
        },
      })
          .then((response) => {
            this.correspondence_id = response.data.data.id;
            this.order_number = response.data.data.order_number;
            this.year = response.data.data.year
            this.reference_number = response.data.data.reference_number
            this.provenance = response.data.data.provenance
            this.classification_code = response.data.data.classification_code
            this.doc_date = response.data.data.doc_date
            this.subject = response.data.data.subject
            this.dispatch = response.data.data.dispatch === 'undefined' ? '' : response.data.data.dispatch
            this.observition = response.data.data.observition === 'undefined' ? '' : response.data.data.observition
            this.forwarded_to = response.data.data.forwarded_to === 'undefined' ? '' : response.data.data.forwarded_to
          })
          .catch((error) => {
            console.log(error);
          });
    },
    getCorrespondence() {
        $(document).ready(() => {
          axios
              .get(`${baseURL}/correspondences/${this.correspondences_id}`, {
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json',
                  'Authorization': `Bearer ${Cookie.getToken()}`,
                }
              })
              .then((response) => {
                this.correspondences = response.data;
                console.log(this.correspondences);
              })
              .catch((error) => console.log(error.response));
        })
      },
    async updateCorrespondence() {
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
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${Cookie.getToken()}`,
          }
        };

        const response = await axios.put(`${baseURL}/correspondences/${this.correspondences_id}`, formData, config);

        if (response.status === 200) {
          this.showAlert('Medical prescription successfully updated', 'success');
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
          this.showAlert('No response from the server. Please check your internet connection.', 'error');
        } else {
          this.showAlert('Error sending request. Please try again later.', 'error');
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
