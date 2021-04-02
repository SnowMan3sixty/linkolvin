<template>
  <div>
    <b-card 
        :title="infoOfertaCompleta.titol"
        tag="article"
        style="max-width: 20rem"
        class="mb-2"
    >
        <b-card-text>
            {{ this.infoOfertaCompleta.empresa_id.nom }}
        </b-card-text>
        <b-card-text>
            {{ this.infoOfertaCompleta.categoria_id.descripcio }}
        </b-card-text>
        <b-card-text>
            {{ this.infoOfertaCompleta.ubicacio }}
        </b-card-text>
        <b-card-text>
            {{ this.infoOfertaCompleta.descripcio }}
        </b-card-text>
        <b-card-text>
            {{ this.infoOfertaCompleta.data_publicacio }}
        </b-card-text>
        <b-card-text>
            Han pasado {{ moment(moment().format('YYYY/MM/DD')).diff(this.infoOfertaCompleta.data_publicacio, 'days') }} días
        </b-card-text>
        <div v-if="$cookies.isKey('micookie')">
          <b-button @click="enviarCVConLogin">Apuntarse a la oferta</b-button>
        </div>
        <div v-else>
          <b-button @click="enviarCVSinLogin">Apuntarse a la oferta</b-button>
        </div>
    </b-card>
  </div>
</template>

<script>
import moment from 'moment';

export default {
  name: 'FichaOfertaCompleta',
  props: {
    infoOfertaCompleta: {}
  },  
  methods : {
    enviarCVConLogin: function(){
      this.$bvModal.msgBoxConfirm('¿Estás seguro de enviar tu CV a esta empresa?', {
        title: 'Confirma antes de enviar',
        size: 'sm',
        buttonSize: 'sm',
        okVariant: 'danger',
        okTitle: 'Sí',
        cancelTitle: 'No',
        footerClass: 'p-2',
        hideHeaderClose: false,
        centered: true
      })
      .then((value) => {
          if (value === true) {
            this.axios.post('http://www.localhost:8000/email', {
              data: {
                correu: this.infoOfertaCompleta.empresa_id.correu,
              },
              headers: {
                'Access-Control-Allow-Origin': '*'
              }
            })
            alert("Tu curriculum ha sido enviado correctamente");
            console.log("Esto va después del alert");
          }
      })

    },
    enviarCVSinLogin: function(){
      alert("Debes iniciar sesión para enviar tu curriculum");
    },
    moment: function () {
      return moment();
    }
  }
}
</script>

<style>
</style>
