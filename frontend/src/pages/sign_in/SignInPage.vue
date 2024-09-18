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
                              <img src="data:image/jpeg;base64,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" width="100" height="35" alt="">
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
            this.showAlert('Login com sucesso.', 'success');

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
            this.showAlert('Erro ao enviar solicitação. Por favor, tente novamente mais tarde.', 'error');
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
