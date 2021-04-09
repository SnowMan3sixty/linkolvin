<template>
  <div>
    <b-card
        :title="infoOfertaCompleta.titol"
        tag="article"
        style="max-width: 30rem"
        class="mb-2"
    >
        <b-card-text>
            Nombre de la empresa: {{ this.infoOfertaCompleta.empresa_id.nom }}
        </b-card-text>
        <b-card-text>
            Categoría de la oferta: {{ this.infoOfertaCompleta.categoria_id.descripcio }}
        </b-card-text>
        <b-card-text>
            Ubicación de la oferta: {{ this.infoOfertaCompleta.ubicacio }}
        </b-card-text>
        <b-card-text>
            Descripción de la oferta: {{ this.infoOfertaCompleta.descripcio }}
        </b-card-text>
        <b-card-text>
            Publicación de la oferta: {{ this.infoOfertaCompleta.data_publicacio }}
        </b-card-text>
        <div v-if="$cookies.isKey('user')">
          <b-button @click="apuntarseOfertaConLogin">Apuntarse a la oferta</b-button>
        </div>
        <div v-else-if="(this.idCandidato_candidat.id == this.idCandidato_real_oferta_candidat.candidat_id) && (this.infoOfertaCompleta.id == this.idCandidato_real_oferta_candidat.oferta_id)">
          <b-text>Ya te has apuntado a esta oferta</b-text>
        </div>
        <div v-else>
          <b-button @click="apuntarseOfertaSinLogin">Apuntarse a la oferta</b-button>
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
      resultado: "",
      idCandidato_candidat: "",
      idCandidato_real_oferta_candidat: "",
      prueba: ""
    };
  },
  methods : {
    apuntarseOfertaConLogin: function(){
      this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/candidat?filter=usuari_id,eq," +this.$cookies.get("user")).then((response) => {
        //console.log(response.data.records[0]);
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
    apuntarseOfertaSinLogin: function(){
      alert("Debes iniciar sesión para apuntarte a la oferta");
    },
    moment: function () {
      return moment();
    }
  },
  // mounted() {
  //   this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/candidat?filter=usuari_id,eq," +this.$cookies.get("user")).then((response) => {
  //     //console.log(response.data.records[0]);
  //     this.idCandidato_candidat = response.data.records[0];
  //     console.log("El id del candidato es: "+this.idCandidato_candidat.id);
  //     this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/real_oferta_candidat?filter=candidat_id,eq," +this.idCandidato_candidat.id).then((response) => {
  //       console.log("TABLA REAL" + response.data.records);
  //       this.idCandidato_real_oferta_candidat = response.data.records[0];
  //       console.log("El id del candidato de la tabla nueva es: "+this.idCandidato_real_oferta_candidat.candidat_id);
  //     });
  //   }),
  //   this.axios.get("http://labs.iam.cat/~a18kevlarpal/transversal3/api.php/records/candidat?filter=oferta_id,eq," +this.infoOfertaCompleta.id).then((response) => {
  //     //console.log(response.data.records[0]);
  //     this.prueba = response.data.records[0];
  //     console.log("La id de la oferta es: "+this.prueba.id);
  //   })
  // }
}
</script>

<style>
</style>
