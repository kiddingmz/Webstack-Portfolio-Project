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
                        <form @submit.prevent="onLogin()">
                        <div class="app-card-body">
                          <div class="row mb-3">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              Medical Prescription
                            </div>
                          </div>
                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                              <input
                                  name="email" type="email"
                                  class="form-control" placeholder="email"
                                  v-model="email"
                              >
                              <div class="invalid-feedback is-invalid">
                              </div>
                              <div class="invalid-feedback" v-if="errors.email">
                                {{ errors.email }}
                              </div>
                            </div>
                          </div>
                          <div class="row mb-1 d-flex justify-content-center align-items-center">
                            <div class="d-flex justify-content-center align-items-center flex-column">
                              <input
                                  name="password" type="password"
                                  class="form-control" placeholder="password"
                                  v-model="password"
                              >
                            </div>

                            <div class="invalid-feedback is-invalid">
                            </div>
                            <div style="max-width: 300px;" class="invalid-feedback d-flex" v-if="errors.password">
                              {{ errors.password }}
                            </div>
                          </div>

<!--                          <div class="row">-->
<!--                            <div class="col-md-4">-->
<!--                              <label for="validationServerUsername" class="form-label">Username</label>-->
<!--                              <div class="input-group has-validation">-->
<!--                                <span class="input-group-text" id="inputGroupPrepend3">@</span>-->
<!--                                <input type="text" class="form-control is-invalid" id="validationServerUsername" aria-describedby="inputGroupPrepend3 validationServerUsernameFeedback" required>-->
<!--                                <div id="validationServerUsernameFeedback" class="invalid-feedback">-->
<!--                                  Please choose a username.-->
<!--                                </div>-->
<!--                              </div>-->
<!--                            </div>-->
<!--                          </div>-->
                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <p>Forgot your password?</p>
                            </div>
                          </div>

                          <div class="row">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                              <button type="submit" class="btn app-btn-primary ml-2">Login</button>
                            </div>
                          </div>

                        </div>
                        </form>
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
  // import {Form} from 'vee-validate';
  import { mapState } from 'vuex';
  import axios from "axios";
  import baseURL from "@/services/api";
  // import cookie from 'js-cookie';
  // import Token from "@/services/token";
  import Cookie from "@/services/cookie";
  // import Validations from "@/services/Validations";
  // import SignupValidations from "@/services/SignupValidations";
  import SigninValidations from "@/services/SigninValidations";

  export default {
    name: 'SignInPage',
    components: {
      // Form
    },
    computed: {
      ...mapState('auth', {
        name: (state) => state.name,
      }),
    },
    data() {
      return {
        email: '',
        password: '',
        errors: []
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
      onLogin() {
        let validations = new SigninValidations(this.email, this.password);
        this.errors = validations.checkValidations();

        if (this.errors.length) {
          return false;
        }

        this.login();

      },
      async login() {
        try {
          const dataToSave = {
            email: this.email,
            password: this.password,
          };

          const config = {
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json',
            }
          };

          const response = await axios.post(`${baseURL}/login`, dataToSave, config);

          if (response.status === 200) {
            this.showAlert('Login successfully.', 'success');

            // cookie.set('token', `Bearer ${response.data.data.token}`, { expires: 1 });
            Cookie.setToken(response.data.data.token);

            this.$store.commit('user/STORE_USER', response.data.data);
            setTimeout(() => {
              // console.log(Token);
              // console.log(Token);
              this.$router.push({ name: 'home' });
              // console.log(response.data.data.token);
            }, 2400);
          }
        } catch (error) {
          if (error.response) {
            // console.log(error.response.status);
            if (error.response.status === 401 || error.response.status === 404)
              this.showAlert('Invalid credentials.', 'error');
            else
              this.showAlert('Error sending request. Please try again later.', 'error');
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

input[type="email"], input[type="password"]{
  font-size: 15px;
  font-weight: 100 !important;
  line-height: 20px !important;
  letter-spacing: 0.5px !important;
  color: black;
}

input:focus {
  outline: 2px solid #15a362 !important;
}

.error-message {
  padding: .25rem .5rem;
  margin-top: .1rem;
  font-size: 0.875rem;
  color: #fff;
  background-color: rgba(220,53,69,.9);
  border-radius: .25rem;
}
</style>
