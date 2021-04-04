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
            {{ this.infoOfertaCompleta.empresa_id.usuari_id }}
        </b-card-text>
        <b-card-text>
            Han pasado {{ moment(moment().format('YYYY/MM/DD')).diff(this.infoOfertaCompleta.data_publicacio, 'days') }} días
        </b-card-text>
        <div v-if="$cookies.isKey('user')">
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
  data() {
    return {
      resultado: ""
    };
  },
  methods : {
    enviarCVConLogin: function(){
      this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/candidat?filter=usuari_id,eq," +this.$cookies.get("user")).then((response) => {
        console.log(response.data.records[0]);
        this.resultado = response.data.records[0];
        console.log("La id de la oferta es: "+this.infoOfertaCompleta.id);
        console.log("El id del candidato es: "+this.resultado.id);
        
      });
      this.$bvModal.msgBoxConfirm('¿Estás seguro de apuntarte a la oferta de esta empresa?', {
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
            console.log("La id de la oferta fuera del axios get es: "+this.infoOfertaCompleta.id);
            console.log("El id del candidato fuera del axios get es: "+this.resultado.id);
            this.axios.post('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/real_oferta_candidat', {
                oferta_id: this.infoOfertaCompleta.id,
                candidat_id: this.resultado.id
            })
            .then((response) => {
              console.log(response);
            }, (error) => {
              console.log(error);
            });
            // alert("Tu curriculum ha sido enviado correctamente");
            // console.log("Esto va después del alert");
            // this.axios.post('http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/oferta_candidat',{ofertaID:this.infoOfertaCompleta.id, candidatoID:this.resultado.id}).then((response) => {
            //   console.log(response.data);
            //   alert("Te apuntaste a la oferta correctamente");
            // })
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
