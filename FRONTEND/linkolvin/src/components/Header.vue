<template>
  <div>
    <b-navbar toggleable="lg" type="dark" variant="dark">
      <b-navbar-brand href="#">Linkolvin</b-navbar-brand>
      <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
      <b-navbar-nav class="ml-auto">
        <div v-if="$cookies.isKey('user')">
          <b-button id="btn-exit" variant="primary" size="sm" class="my-2 my-sm-0 btn-space" href="http://localhost:8000/login" @click="exit">Salir</b-button>
        </div>
        <div v-else>
          <b-button variant="primary" size="sm" class="my-2 my-sm-0 btn-space" href="http://localhost:8000/login">Iniciar Sesión</b-button>
          <b-button variant="primary" size="sm" class="my-2 my-sm-0">Registrarte</b-button>
        </div>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script>

export default {
  name: "Header",
  props: {
    msg: String,
  },
  methods: {
    exit: function () {
      this.$cookies.remove("user");
      window.location.href = "http://localhost:8000/logout";
    }
  }
};

</script>

<style>
</style>