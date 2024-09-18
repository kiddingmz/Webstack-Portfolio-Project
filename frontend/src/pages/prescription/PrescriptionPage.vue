<template>
  <HeaderComponent/>
  <div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
      <div class="row g-3 mb-4 align-items-center justify-content-between">
        <div class="col-auto">
          <h1 class="app-page-title mb-0"></h1>
        </div>
        <div class="col-auto">
          <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
              <router-link
                  :to="{ name: 'prescriptionCreate'}"
                  class="btn app-btn-secondary"
              >
                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                </svg>
                Prescription
              </router-link>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4 mb-4">
        <div class="col-12 col-md-12">
          <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
              <div class="app-card-body">
                <nav class="orders-table-tab app-nav-tabs nav shadow flex-column flex-sm-row mb-4">
                  <a class="flex-sm-fill text-sm-center nav-link active " id="orders-all-tab" data-bs-toggle="tab" role="tab" aria-controls="orders-all" aria-selected="true">Prescription</a>
                </nav>

                <div id="" class="row mt-3">
                  <div class="col-12 col-md-12">
                    <div class="app-card app-card-stats-table h-100 shadow-sm">
                      <div class="col-12 col-md-12">
                        <div class="app-card app-card-settings shadow-sm p-4">
                          <div class="app-card-body">
                            <div class="mb-0">
                              <div class="col-auto">
                                <div class="page-utilities">
                                  <div class="row g-2 justify-content-start justify-content-md-around align-items-center gap-1 mb-3">

                                  </div>
                                </div>
                              </div>
                              <div class="app-card-body mb-5">
                                <div class="table-responsive mb-5">
                                  <table id="correspondencesTable" class="table app-table-hover mb-0 text-left ">
                                    <thead>
                                      <tr>
                                        <th colspan="3" class="cell border bg-grey align-vertical-middle text-center text-secondary">Entry</th>
                                        <th colspan="5" class="cell border bg-grey align-vertical-middle text-center text-secondary">Document Reference</th>
                                        <th rowspan="3" class="cell border bg-grey align-vertical-middle text-center text-secondary">Forwarded to</th>
                                        <th rowspan="3" class="cell border bg-grey align-vertical-middle text-center text-secondary">Dispatch</th>
                                        <th rowspan="3" class="cell border bg-grey align-vertical-middle text-center text-secondary">Observations</th>
                                        <th rowspan="3" class="cell border bg-grey align-vertical-middle text-center text-secondary">Document</th>
                                        <th rowspan="3" class="cell border bg-grey align-vertical-middle text-center text-secondary">Actions</th>
                                      </tr>
                                      <tr>
                                        <th rowspan="2" class="cell border bg-grey align-vertical-middle text-center text-secondary">Order Number</th>
                                        <th colspan="2" class="cell border bg-grey align-vertical-middle text-center text-secondary">Year</th>
                                        <th rowspan="2" class="cell border bg-grey align-vertical-middle text-center text-secondary">Number</th>
                                        <th rowspan="2" class="cell border bg-grey align-vertical-middle text-center text-secondary">Provenance</th>
                                        <th rowspan="2" class="cell border bg-grey align-vertical-middle text-center text-secondary">Classification Code</th>
                                        <th colspan="2" class="cell border bg-grey align-vertical-middle text-center text-secondary">Document Date</th>
                                      </tr>
                                      <tr>
                                        <th class="cell border bg-grey align-vertical-middle text-center text-secondary">Month</th>
                                        <th class="cell border bg-grey align-vertical-middle text-center text-secondary">Day</th>
                                        <th class="cell border bg-grey align-vertical-middle text-center text-secondary">Month</th>
                                        <th class="cell border bg-grey align-vertical-middle text-center text-secondary">Year</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr v-for="correspondence in correspondences.data" :key="correspondence.id">
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.order_number }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ getMonth(correspondence.year) }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ getDay(correspondence.year) }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.reference_number }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.provenance }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.classification_code }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ getMonth(correspondence.doc_date) }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ getYear(correspondence.doc_date) }}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.forwarded_to  === 'undefined' ? ' ' : correspondence.forwarded_to}}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.dispatch  === 'undefined' ? ' ' : correspondence.dispatch}}</td>
                                        <td class="cell border align-vertical-middle text-secondary">{{ correspondence.observition === 'undefined' ? ' ' : correspondence.observition }}</td>
                                        <td class="cell text-center align-vertical-middle border">

                                          <a target="_blank" :href="baseURLFileUploaded+correspondence.pdf_path" v-if="correspondence.pdf_path">
                                            <span class="badge text-center text-danger">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
  <path d="M5.523 12.424q.21-.124.459-.238a8 8 0 0 1-.45.606c-.28.337-.498.516-.635.572l-.035.012a.3.3 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548m2.455-1.647q-.178.037-.356.078a21 21 0 0 0 .5-1.05 12 12 0 0 0 .51.858q-.326.048-.654.114m2.525.939a4 4 0 0 1-.435-.41q.344.007.612.054c.317.057.466.147.518.209a.1.1 0 0 1 .026.064.44.44 0 0 1-.06.2.3.3 0 0 1-.094.124.1.1 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256M8.278 6.97c-.04.244-.108.524-.2.829a5 5 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.5.5 0 0 1 .145-.04c.013.03.028.092.032.198q.008.183-.038.465z"/>
  <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2m5.5 1.5v2a1 1 0 0 0 1 1h2zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.7 11.7 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.86.86 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.84.84 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.8 5.8 0 0 0-1.335-.05 11 11 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.24 1.24 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a20 20 0 0 1-1.062 2.227 7.7 7.7 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103"/>
</svg>
                                            </span>
                                          </a>

                                        </td>
                                        <td class="cell text-center align-vertical-middle border">

                                          <router-link
                                            :to="{ name: 'prescriptionUpdate', params: { id: correspondence.id } }"
                                            >
                                            <span class="badge text-primary">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                              </svg>
                                            </span>
                                          </router-link>

                                          <a class="add-row" @click="removeCorrespondence(correspondence.id)">
                                            <span class="badge text-center text-danger">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                              </svg>
                                            </span>
                                          </a>

                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
  import HeaderComponent from "@/components/HeaderComponent.vue";
  window.pdfMake = require('pdfmake/build/pdfmake.js');
  var vfs = require('pdfmake/build/vfs_fonts');
  window.pdfMake.vfs = vfs.pdfMake.vfs;
  import axios from "axios";
  import $ from "jquery";
  // import "datatables.net";
  import { format } from 'date-fns';
  import { ptBR } from 'date-fns/locale';
  // import Swal from 'sweetalert2/dist/sweetalert2.js'
  import 'sweetalert2/src/sweetalert2.scss'
  import baseURL from "@/services/api";
  // import Token from "@/services/token";
  import Cookie from "@/services/cookie";
  import baseURLFileUploaded from "@/services/GetFileUploaded";


export default {
  name: 'CorrespondencePage',
  computed: {
    baseURLFileUploaded() {
      return baseURLFileUploaded
    }
  },
  components: {HeaderComponent},
  data() {
    return {
      correspondences: [],
    }
  },
  mounted() {
    this.initTable();
  },
  methods: {
    initTable() {
      $(document).ready(() => {
        axios
            .get(`${baseURL}/correspondences`, {
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${Cookie.getToken()}`,
              }
            })
            .then((response) => {
              this.correspondences = response.data;
              this.$nextTick(() => {
                $("#correspondencesTable").DataTable({
                  dom: '<"d-flex mb-3 input-group-sm form-control-sm"B>' +
                      '<"d-flex justify-content-between mb-3 input-group-sm form-control-sm"lf>' +
                      't' +
                      '<"bottom d-flex mt-3"p><"clear">',
                  paging: true,
                  autoWidth: true,
                  buttons: [
                    'colvis',
                    'copyHtml5',
                    'csvHtml5',
                    'excelHtml5',
                    {
                      extend: 'pdfHtml5',
                      exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                      },
                      // orientation: 'landscape',
                      pageSize: 'LEGAL',
                      customize: function ( doc ) {
                        doc.title = "";

                        // doc.pageMargins = [40, 40, 120, 40];

                        // doc.styles.tableHeader.fontSize = 8;
                        //
                        // doc.styles.tableHeader = {
                        //   // fillColor: '#f5f5f5',
                        //   fontSize: 8,
                        //   bold: true,
                        //   color: 'black',
                        //   border: [true, true, true, true],
                        //   borderColor: '#828282',
                        //   lineColor: '#000000',
                        //   lineWidth: 1,
                        // };

                        // doc.styles.tableHeader = {
                        //   bold: true,
                        //   fontSize: 10,
                        //   fillColor: '#CCCCCC',
                        //   color: 'black',
                        //   alignment: 'center'
                        // };

                        doc.styles.tableHeader = {
                          bold: true,
                          fontSize: 8,
                          fillColor: '#CCCCCC',
                          color: 'black',
                          alignment: 'center'
                        };

                        doc.styles.tableBody = {
                          fontSize: 8,
                          lineColor: '#CCCCCC',
                          borderColor: '#000000'
                        };

                        doc.content.splice( 1, 0, {
                          alignment: 'center',
                          margin: [0, 0, 0, 40],
                          text: 'Medical Prescription\n',
                          bold: true,
                          fontSize: 10
                        } );


                        doc.styles.title = {
                          display: 'none'
                        }

                        doc.content.splice(0, 1);
                        doc.defaultStyle.fontSize = 8;
                      },
                    },
                    // {
                    //   extend: 'pdfHtml5',
                    //   download: 'open',
                    //   exportOptions: {
                    //     columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                    //   },
                    // },
                    {
                      extend: 'print',
                      exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
                      },
                      customize: function (win) {

                        $(win.document.body).find('h1').css('display', 'none');

                        $(win.document.body).find('table').attr('style', 'border-collapse: collapse !important; width: 100% !important;');
                        $(win.document.body).find('table.dataTable').attr('style', 'width: 100% !important;');
                        // $(win.document.body).find('th, td').attr('style', 'border: 1px solid black !important; padding: 8px !important;');

                        $(win.document.body)
                            .css('font-size', '10pt')
                            .prepend(
                                '<div style="text-align: center;">' +
                                '<h5 style="padding-top: 10px;">Medical Prescription </h5>' +
                                '</div>'
                            );

                        $(win.document.body)
                            .find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');


                        $(win.document.body).css('font-size', '10pt');

                        // Aplica as propriedades do PDF para o botão de impressão
                        $(win.document.body).find('table').css({
                          'font-size': '8pt',
                          'color': 'black'
                        });

                        $(win.document.body).find('th').css({
                          'background-color': '#CCCCCC',
                          'color': 'black',
                          'font-weight': 'bold',
                          'text-align': 'center'
                        });

                        $(win.document.body).find('td').css({
                          'border-color': '#000000',
                          'border-width': '1px',
                          'border-style': 'solid'
                        });
                      }
                    }
                  ],
                  language: {
                    buttons: {
                      colvis: 'Visibilidade da Coluna',
                      copy: 'Copiar',
                      csv: 'CSV',
                      excel: 'Excel',
                      pdf: 'PDF',
                      print: 'Imprimir'
                    },
                    search: "Pesquisar:",
                    lengthMenu: "Mostrar _MENU_ entradas",
                  },
                  initComplete: function () {
                    $('.buttons-copy').removeClass('btn btn-secondary').addClass('btn app-btn-secondary btn-sm');
                    $('.buttons-csv').removeClass('btn btn-secondary').addClass('btn app-btn-secondary btn-sm');
                    $('.buttons-excel').removeClass('btn btn-secondary').addClass('btn app-btn-secondary btn-sm');
                    $('.buttons-pdf').removeClass('btn btn-secondary').addClass('btn app-btn-secondary btn-sm');
                    $('.buttons-print').removeClass('btn btn-secondary').addClass('btn app-btn-secondary btn-sm');
                    $('.buttons-colvis').removeClass('btn btn-secondary').addClass('btn app-btn-secondary btn-sm');
                    $('.dt-buttons').removeClass('btn-group').addClass('btn-group-sm d-flex').find('.btn-group').removeClass('btn-group').addClass('btn-group-sm');
                  },
                  columnDefs: [
                    {
                      targets: -1,
                      className: 'no-print'
                    }
                  ]
                });
              });
            })
            .catch((error) => console.log(error.response));
      })
    },
    editCorrespondence(id) {
      console.log(id);
    },
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
    showSwal(title, text, icon, confirmButtonText, alertMsg, alertType, alertPosition) {
      this.$swal({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText
      }).then((result) => {
        if (result.isConfirmed) {

          this.showAlert(alertMsg, alertType, alertPosition);
        }
      })
    },
    showSwalDelete(id, title, text, icon, confirmButtonText, alertMsg, alertType, alertPosition) {
      this.$swal({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmButtonText
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteCorrespondence(id);
          // console.log(status.value);

          this.showAlert(alertMsg, alertType, alertPosition);
          // $("#correspondencesTable").load(location.href + " #correspondencesTable");
          setTimeout(function() {
            window.location.reload();
          }, 2400);
            // if ( status === 200){
            //   this.showAlert(alertMsg, alertType, alertPosition);
            //   $("#correspondencesTable").load(location.href + " #correspondencesTable");
            // } else {
            //   this.showAlert("Erro ao apagar!", "error", "center");
            // }

        }
      })
    },
    removeCorrespondence(id) {
      console.log(id);
      //this.showAlert(id, "success");
      this.showSwalDelete(id, 'Tem a certeza?', "Não poderá reverter esta ação!",
                    'warning', 'Sim, apague!', 'Apagado com sucesso!',
                    'success', 'center');
    },
    async deleteCorrespondence(correspondence_id) {
      try {

        const config = {
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${Cookie.getToken()}`,
          }
        };

        const response = await axios.delete(`${baseURL}/correspondences/${correspondence_id}`, config);
        return response.status;
      } catch (error) {
        console.error(error)
      }
    },
    fullDateFormatPtBR: (dataForFormat) => format(new Date(dataForFormat), 'dd MMMM yyyy', { locale: ptBR }),
    getDay: (dataForFormat) => format(new Date(dataForFormat), 'dd', { locale: ptBR }),
    getMonth: (dataForFormat) => format(new Date(dataForFormat), 'MMMM', { locale: ptBR }),
    getYear: (dataForFormat) => format(new Date(dataForFormat), 'yyyy', { locale: ptBR }),
  },
};
</script>

<style>
@media print {
  @page {
    /*size: A4 landscape;*/
    size: A4;
    margin: 2cm;
  }
}

@media pdf {
  @page {
    /*size: A4 landscape;*/
    size: A4;
    margin: 2cm;
  }
}

  table {
    border-collapse: collapse;
    width: 100%;
  }

  th, td {
    border: 1px solid #dddddd;
    /*text-align: left;*/
    /*padding: 8px;*/
    /*color: dimgrey;*/
    color: #525151;
    font-family: system-ui, -apple-system, "Segoe UI",
    Roboto, "Helvetica Neue", Arial, "Noto Sans",
    "Liberation Sans", sans-serif,
    "Apple Color Emoji", "Segoe UI Emoji",
    "Segoe UI Symbol", "Noto Color Emoji";
  }

  th {
    background-color: #f2f2f2;
  }

  .bg-grey {
    background-color: #f5f5f5 !important;
  }

  .align-vertical-middle{
    vertical-align: middle;
  }

  .dataTables_wrapper .dt-buttons {
  float: right;
  margin-bottom: 10px;
  }

  .dt-buttons {
    gap: 10px;
  }

  .dropdown-item{
    /*background-color: #15a362;*/
  }
  .buttons-columnVisibility{
    /*background-color: #15a362;*/
  }
  .buttons-csv,
  .buttons-print,
  .buttons-pdf,
  .buttons-colvis
  {
    /*background: #15a362;
    color: #fff;
    font-weight: 600;
    padding: .4rem 1rem;
    font-size: .875rem;
    border: none #15a362;*/
  }

  .buttons-csv:hover,
  .buttons-pdf:hover,
  .buttons-print:hover,
  .buttons-colvis:hover
  {
    /*background-color: #13b96d;*/
  }
  .dt-button-collection .dropdown-item:hover{
    background-color: #22945e;
    //background-color: #f5f5f5;
    color: white;
  }
  .dt-button-collection .dropdown-item.active{
    //background-color: #15a362;
  }

  .page-link {
    color: #15a362;
  }
  .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #15a362;;
    border-color: #15a362;;
  }
</style>
