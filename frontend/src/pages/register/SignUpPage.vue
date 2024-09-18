<template>
  <div class="centered-card">
    <div class="app-card app-card-stats-table plus-w">
      <div class="row">
        <div class="col-12">
          <div class="app-card app-card-settings p-4 bg-body-tertiary">
            <div class="app-card-body">
              <div class="row g-4 section">
                <div class="col-10 col-sm-10">
                  <div class="app-card app-card-stats-table shadow-lg">
                    <div class="col-12">
                      <div class="app-card app-card-settings shadow-sm p-4 rounded ">
                        <Form
                            tag="form"
                            @submit="register"
                        >
                        <div class="app-card-body ">
                          <div class="row mb-3">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              Medical Prescription
                            </div>
                          </div>

                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <p><strong>Registering a new user</strong></p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <input
                                  name="name" type="email"
                                  class="form-control"
                                  placeholder="name"
                                  v-model="name"
                              >
                            </div>
                          </div>

                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <input name="email" type="email"
                                     class="form-control"
                                     placeholder="email"
                                     v-model="email"
                              >
                            </div>
                          </div>

                          <div class="row mb-1">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <input name="password" type="password"
                                     class="form-control"
                                     placeholder="password"
                                     v-model="password"
                              >
                            </div>
                          </div>

                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <button type="submit" class="btn app-btn-primary ml-2">Sign up</button>
                            </div>
                          </div>

                        </div>
                        </Form>
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
import {Form} from 'vee-validate';
import axios from "axios";
import baseURL from "@/services/api";
export default {
  name: 'SignUpPage',
  components: {
    Form
  },
  data() {
    return {
      name: '',
      email: '',
      password: '',
    }
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
      })
    },
    async register() {
      try {
        const dataToSave = {
          name: this.name,
          email: this.email,
          password: this.password,
        };

        const config = {
          headers: {
            'Accept': 'application/json',
          }
        };

        const response = await axios.post(`${baseURL}/register`, dataToSave, config);

        if (response.status === 201) {
          this.showAlert('User registered successfully. Rediting in 2s', 'success');
          setTimeout(() => {
            this.$router.push({ name: 'login' });
          }, 2400);
        }
      } catch (error) {
        if (error.response) {
          if (error.response.status === 409) {
            this.showAlert('User already exists', 'error');
          } else if (error.response.status === 422) {
            this.showAlert('Error registering user. Data already used', 'error');
          }
          else {
            this.showAlert('Error registering user. Please try again later.', 'error');
          }
        } else if (error.request) {
          this.showAlert('No response from the server. Please check your internet connection.', 'error');
        } else {
          this.showAlert('Error sending request. Please try again later.', 'error');
        }
      }
    }

  }
};
</script>

<style scoped>

@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

* {
  box-sizing: border-box;
}

.centered-card {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.plus-w {
  width: 120%;
}

button {
  border-radius: 20px !important;
  border: 1px solid #15a362 !important;
  background-color: #15a362 !important;
  color: #FFFFFF !important;
  font-size: 12px !important;
  font-weight: bold !important;
  padding: 9px 45px !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
  transition: transform 80ms ease-in !important;
}

button:active {
  transform: scale(0.95) !important;
}

button:focus {
  outline: none !important;
}

p {
  font-size: 14px !important;
  font-weight: 100 !important;
  line-height: 20px !important;
  letter-spacing: 0.5px !important;
}

input {
  background-color: #eee !important;
  border: none !important;
  padding: 12px 15px !important;
  margin: 8px 0 !important;
  width: 100% !important;
}

input[type="email"], input[type="password"], input[type="text"]{
  font-size: 15px;
  font-weight: 100 !important;
  line-height: 20px !important;
  letter-spacing: 0.5px !important;
  color: black;
}

input:focus {
  outline: 2px solid #15a362 !important;
}
</style>
