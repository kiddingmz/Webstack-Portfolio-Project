<template>
  <HeaderComponent/>
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <h1 class="app-page-title text-start"></h1>
      <div class="row g-4 mb-4">
        <div class="col-12 col-md-12">
          <div class="app-card app-card-stats-table h-100 shadow-sm">
            <div class="app-card-header p-3">
              <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                  <h4 class="app-card-title">Ultimos registos de correpondencia</h4>
                </div>
                <div class="col-auto">
                  <div class="card-header-action">
                    <router-link :to="{ name: 'prescription'}">Ver correpondencia</router-link>
                  </div>
                </div>
              </div>
            </div>
            <div class="app-card-body p-3 p-lg-4">
              <div class="table-responsive">
                <table class="table table-borderless mb-0">
                  <thead>
                    <tr>
                      <th colspan="2" class="cell border bg-grey text-secondary">Entrada</th>
                      <th colspan="4" class="cell   border bg-grey text-secondary">Referencia do Documento</th>
                    </tr>
                    <tr>
                      <th class="cell border bg-grey text-secondary">Número de Ordem</th>
                      <th class="cell   border bg-grey text-secondary">Data</th>
                      <th class="cell   border bg-grey text-secondary">Número</th>
                      <th class="cell   border bg-grey text-secondary">Proveniência</th>
                      <th class="cell   border bg-grey text-secondary">Codigo de Classificação</th>
                      <th class="cell   border bg-grey text-secondary">Data do Documento</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td class="cell border align-vertical-middle text-secondary">{{  }}</td>
                    <td class="cell border align-vertical-middle text-secondary">{{  }}</td>
                    <td class="cell border align-vertical-middle text-secondary">{{  }}</td>
                    <td class="cell border align-vertical-middle text-secondary">{{  }}</td>
                    <td class="cell border align-vertical-middle text-secondary">{{  }}</td>
                    <td class="cell border align-vertical-middle text-secondary">{{  }}</td>
                  </tr>

                    <tr v-for="correspondence in correspondences.data" :key="correspondence.id">
                      <td class="cell border align-vertical-middle text-secondary">{{ correspondence.order_number }}</td>
                      <td class="cell border align-vertical-middle text-secondary">{{ fullDateFormatPtBR(correspondence.year) }}</td>
                      <td class="cell border align-vertical-middle text-secondary">{{ correspondence.number }}</td>
                      <td class="cell border align-vertical-middle text-secondary">{{ correspondence.provenance }}</td>
                      <td class="cell border align-vertical-middle text-secondary">{{ correspondence.classification_code }}</td>
                      <td class="cell border align-vertical-middle text-secondary">{{ fullDateFormatPtBR(correspondence.doc_date) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div><!--//table-responsive-->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import HeaderComponent from "@/components/HeaderComponent.vue";
import $ from "jquery";
import axios from "axios";
import baseURL from "@/services/api";
import Cookie from "@/services/cookie";
import { format } from 'date-fns';
import { ptBR } from 'date-fns/locale';

export default {
  name: 'HomePage',
  components: {HeaderComponent},
  data() {
    return {
      correspondences: [],
    }
  },
  mounted() {
    this.initDataCorrespondences();
  },
  methods: {
    initDataCorrespondences() {
      $(document).ready(() => {
        axios
            .get(`${baseURL}/correspondences/5/desc`, {
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${Cookie.getToken()}`,
              }
            })
            .then((response) => {
              this.correspondences = response.data;
              console.log(response);
            })
            .catch((error) => console.log(error.response));
      })
    },
    fullDateFormatPtBR: (dataForFormat) => format(new Date(dataForFormat), 'dd MMMM yyyy', { locale: ptBR }),
  }
}
</script>

<style scoped>
  @import "@/assets/static/css/portal.css";
  .centered-card {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-65%, -50%);
  }

  .plus-w {
    width: 130%;
  }

  .bg-grey {
    background-color: #f5f5f5 !important;
  }

</style>
