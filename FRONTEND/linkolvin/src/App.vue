<template>
  <div>
    <Header/>
    <div id="principal">
      <h1>INTERFAZ INICIAL</h1>
      <b-dropdown text="Filtrar por categoría" class="m-md-2">
        <b-dropdown-item-button @click="todo">TODO</b-dropdown-item-button>
        <b-dropdown-item-button @click="asix">ASIX</b-dropdown-item-button>
        <b-dropdown-item-button @click="daw">DAW</b-dropdown-item-button>
        <b-dropdown-item-button @click="dam">DAM</b-dropdown-item-button>
        <b-dropdown-item-button @click="smx">SMX</b-dropdown-item-button>
      </b-dropdown>
      <button @click="setCookie">Set Cookie</button>
      <!-- <div class="row">
        <div class="col-md-3 col-3 my-1">
        <FichaOferta v-for="oferta in resultado"
          :key="oferta.id"
          :infoOferta="oferta">
        </FichaOferta>
        </div>
      </div> -->
      <b-container class="d-flex justify-center">
        <b-card-group class="row">
            <FichaOferta v-for="oferta in resultado"
              :key="oferta.id"
              :infoOferta="oferta">
            </FichaOferta>
        </b-card-group>
      </b-container>
      <b-modal id="modalOfertaCompleta" title="Oferta Completa">
        <FichaOfertaCompleta :infoOfertaCompleta="modal">
        </FichaOfertaCompleta>
      </b-modal>
      <Graficos line-chart :chartdata="chartData" :options="chartOptions"></Graficos>
    </div>
  </div>
</template>

<script>
import Header from './components/Header.vue'
import FichaOferta from './components/FichaOferta.vue'
import FichaOfertaCompleta from './components/FichaOfertaCompleta.vue'
import Graficos from './components/Graficos.vue'

export default {
  name: 'App',
  components: {
    Header, FichaOferta, FichaOfertaCompleta, Graficos
  },
  data() {
    return {
      resultado: '',
      modal: ''
    }
  },
  methods : {
    todo: function(){
      this.axios.get('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta').then((response) => {
        console.log(response.data.records);
        this.resultado=response.data.records;
      })
    },
    asix: function(){
      this.axios.get('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,2').then((response) => {
        console.log(response.data.records);
        this.resultado=response.data.records;
      })
    },
    daw: function(){
      this.axios.get('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,3').then((response) => {
        console.log(response.data.records);
        this.resultado=response.data.records;
      })
    },
    dam: function(){
      this.axios.get('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,4').then((response) => {
        console.log(response.data.records);
        this.resultado=response.data.records;
      })
    },
    smx: function(){
      this.axios.get('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta?filter=categoria_id,eq,5').then((response) => {
        console.log(response.data.records);
        this.resultado=response.data.records;
      })
    },
    setCookie(){
         // it gets the cookie called `username`
      const kevinset = this.$cookies.set("micookie", 2);
      console.log(kevinset);
    }
  },
  mounted() {
    this.axios.get('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta').then((response) => {
      console.log(response.data.records);
      this.resultado=response.data.records;
      //alert(this.$session.exists());
      //alert(this.$cookies.isKey('micookie'));
    })
  }
}
</script>

<style>
#principal {
  text-align: center;
}
html, body {
    max-width: 100%;
    overflow-x: hidden;
}
.row {
   display: flex;
   flex-wrap: wrap;
}
.row > div[class*='col-'] {
  display: flex;
}
</style>
