<template>
  <nav class="navbar navbar-expand-lg navbar-light sticky-top bg-white shadow-sm p-4 justify-content-between">
    <a class="navbar-brand" href="#">
      Medical Prescription
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto gap-5">
        <li class="nav-item">
          <router-link :to="{ name: 'home'}">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{ name: 'prescription'}">Prescription</router-link>
        </li>
      </ul>
    </div>

    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto gap-5">
        <li class="nav-item dropdown">
          <a class="" href="#" role="button" @click="logout">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
            </svg>
             Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>
  import { mapState } from 'vuex';
  import Cookie from "@/services/cookie";
  export default {
    name: 'HeaderComponent',
    computed: {
      ...mapState({
        user: state => state.user,
      }),
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
      logout() {
        // this.$store.dispatch('logout');
        // this.$router.push({ name: 'login' });
        this.showAlert('Logout', 'success');
        setTimeout(() => {
          Cookie.removeToken();
          this.$router.push({ name: 'login' });
        }, 2400);
      },
    },
  }
</script>

<style scoped lang="scss">

</style>
