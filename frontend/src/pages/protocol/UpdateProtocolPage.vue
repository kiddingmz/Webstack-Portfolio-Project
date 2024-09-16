<template>
  <HeaderComponent/>
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="col-auto pt-3">
        <h1 class="app-page-title">Actualização de dados de Protocolo</h1>
      </div>
      <form
        novalidate
        @submit.prevent="updateProtocol()"
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
                                    <h4 class="app-card-title">Protocolo</h4>
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
                                        <label  class="form-label">Data: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="year"
                                            type="date"
                                            class="form-control"
                                            v-model="year"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label class="form-label">Número: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="number"
                                            type="text"
                                            class="form-control"
                                            v-model="number"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Proveniência: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="provenance"
                                            type="text"
                                            class="form-control"
                                            v-model="provenance"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label class="form-label">Código de Classificação: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="classification_code"
                                            type="text"
                                            class="form-control"
                                            v-model="classification_code"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Assunto: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="subject"
                                            type="text"
                                            class="form-control"
                                            v-model="subject"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label class="form-label">Data do Documento <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="doc_date"
                                            type="date"
                                            class="form-control bg-white"
                                            v-model="doc_date"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Destinatário: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="destination"
                                            type="text"
                                            class="form-control"
                                            v-model="destination"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Expede: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="name_of_expander"
                                            type="text"
                                            class="form-control"
                                            v-model="name_of_expander"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Recebe: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="name_of_recipient"
                                            type="text"
                                            class="form-control"
                                            v-model="name_of_recipient"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Data da Recepção: <small class="text-danger"><strong>*</strong></small></label>
                                        <input
                                            name="date_of_receipt"
                                            type="date"
                                            class="form-control"
                                            v-model="date_of_receipt"
                                        >
                                      </div>

                                      <div class="col-md-12 col-lg-6 mb-3">
                                        <label  class="form-label">Anexar documento: </label>
                                        <input
                                            ref="file"
                                            accept="application/pdf"
                                            type="file"
                                            name="pdf_path"
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
                    <button type="submit" class="btn app-btn-primary col-12 col-md-12" >Actualizar Protocolo</button>
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
// import {Form} from "vee-validate";
import axios from "axios";
import 'sweetalert2/src/sweetalert2.scss'
import HeaderComponent from "@/components/HeaderComponent.vue";
import baseURL from "@/services/api";
import Cookie from "@/services/cookie";
// import $ from "jquery";

export default {
  name: 'CreateProtocolPage',
  components: {HeaderComponent},
    data() {
      return {
        year: '',
        number: '',
        provenance: '',
        classification_code: '',
        doc_date: '',
        subject: '',
        name_of_expander: '',
        name_of_recipient: '',
        date_of_receipt: '',
        protocol_id: '',
        destination: '',
    }
  },
  computed: {
    protocols_id() {
      return this.$route.params.id;
    }
  },
  created() {
    this.getProcolById();
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
    getProcolById() {
      axios.get(`${baseURL}/protocol-internal-externals/${this.protocols_id}`, {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${Cookie.getToken()}`,
        },
      })
          .then((response) => {
            this.protocol_id = response.data.data.id;
            this.year = response.data.data.year
            this.reference_number = response.data.data.reference_number
            this.provenance = response.data.data.provenance
            this.classification_code = response.data.data.classification_code
            this.doc_date = response.data.data.doc_date
            this.subject = response.data.data.subject
            this.name_of_expander = response.data.data.name_of_expander
            this.name_of_recipient = response.data.data.name_of_recipient
            this.date_of_receipt = response.data.data.date_of_receipt
            this.forwarded_to = response.data.data.forwarded_to
            this.destination = response.data.data.destination
            this.number = response.data.data.number
          })
          .catch((error) => {
            console.log(error);
          });
    },
    async updateProtocol() {
      try {
        const formData = new FormData();
        formData.append('year', this.year === undefined ? '' : this.year);
        formData.append('number', this.number === undefined ? '' : this.number);
        formData.append('provenance', this.provenance === undefined ? '' : this.provenance);
        formData.append('classification_code', this.classification_code === undefined ? '' : this.classification_code);
        formData.append('doc_date', this.doc_date === undefined ? '' : this.doc_date);
        formData.append('subject', this.subject === undefined ? '' : this.subject);
        formData.append('name_of_expander', this.name_of_expander === undefined ? '' : this.name_of_expander);
        formData.append('name_of_recipient', this.name_of_recipient === undefined ? '' : this.name_of_recipient);
        formData.append('date_of_receipt', this.date_of_receipt === undefined ? '' : this.date_of_receipt);
        formData.append('destination', this.destination === undefined ? '' : this.destination);

        if (this.pdf_path) {
          formData.append('pdf_path', this.pdf_path);
        }


        const config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'multipart/form-data',
            'Authorization': `Bearer ${Cookie.getToken()}`,
          }
        };

        const response = await axios.put(`${baseURL}/protocol-internal-externals/${this.protocols_id}`, formData, config);

        if (response.status === 200) {
          this.showAlert('Protocolo actualizado com sucesso', 'success');
          const self = this;
          setTimeout(function() {
            self.$router.push({name: 'protocolo'});
          }, 2400);
        }
      } catch (error) {
        if (error.response){
          if (error.response.status === 422){
            this.showAlert('Preencha todos campos obrigatorios', 'warning');
          }else {
            this.showAlert('Erro ao actualizar o Protocolo', 'error');
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
