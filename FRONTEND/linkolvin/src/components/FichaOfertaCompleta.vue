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
import emailjs from 'emailjs-com';

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
      .then(function(value){
          if (value === true) {
            alert("Tu curriculum ha sido enviado correctamente");
            var templateParams = {
                to_name: 'kevilarriega@gmail.com',
                from_name: 'a18kevlarpal@inspedralbes.cat',
                message_html: 'Please Find out the attached file'
            };
            emailjs.send('service_u5smqsj', 'template_4cooo2i', templateParams, 'user_0CdPDNcOhhrzcq3wy4nk8')
              .then(function(response) {
                console.log('SUCCESS!', response.status, response.text);
              }, function(error) {
                console.log('FAILED...', error);
            });
          }
      })

    },
    enviarCVSinLogin: function(){
      alert("Debes iniciar sesión para enviar tu curriculum");
    }
  }
}
</script>

<style>
</style>
